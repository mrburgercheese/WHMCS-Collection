<?php

/**
 *  __          ___    _ __  __  _____  _____ ______ _    _ _      _       
 *  \ \        / / |  | |  \/  |/ ____|/ ____|  ____| |  | | |    | |      
 *   \ \  /\  / /| |__| | \  / | |    | (___ | |__  | |  | | |    | |      
 *    \ \/  \/ / |  __  | |\/| | |     \___ \|  __| | |  | | |    | |      
 *     \  /\  /  | |  | | |  | | |____ ____) | |    | |__| | |____| |____  
 *      \/  \/   |_|  |_|_|  |_|\_____|_____/|_|     \____/|______|______|                                                       
 *                  LICENSE SYSTEM BY WHMCSFULL.COM 
 *
 * Author:        Jesus Suarez
 * Created:       10/05/2025
 * Update:		  13/05/2025
 * Website:       https://whmcsfull.com
 * LinkedIn:      https://www.linkedin.com/in/jesussuarz/
 * GitHub:        https://github.com/jesussuarz
 * Forum (Gist):  https://gist.github.com/jesussuarz/0b74fec85031a8e50d2f78187aaa46d3
 *
 * This license system was created to simplify local validation for WHMCS modules.
 * It is maintained as long as it receives support from the community.
 *
 * Donations are welcome to keep the project alive:
 * https://www.paypal.com/paypalme/jesussuarz
 *
 * Use it responsibly, contribute back if you improve it!
 */

namespace WHMCS;

use WHMCS\Config\Setting;
use Illuminate\Support\Collection;
use WHMCS\Carbon;

class RemoteCheckManager
{
    private $settingKey = "LicenseRemoteChecks";
    private $timeoutMinutes;
    private $checksLimit;
    private $dateFormat = "Y-m-d H:i:s";
    private $lastChecks;

    public function __construct(int $timeoutMinutes, int $checksLimit)
    {
        $this->timeoutMinutes = $timeoutMinutes;
        $this->checksLimit = $checksLimit;
        $this->lastChecks = new Collection();
    }

    public function init(): self
    {
        $lastChecks = Setting::getValue($this->settingKey);
        if (!empty($lastChecks)) {
            $decoded = json_decode($lastChecks, true);
            $this->lastChecks = collect($decoded)->map(function ($datetimeString) {
                return Carbon::createFromFormat($this->dateFormat, $datetimeString);
            });
        }
        return $this;
    }

    public function shouldCheck(): bool
    {
        if ($this->lastChecks->isEmpty()) {
            return true;
        }

        $currentTime = Carbon::now();
        $cutoffTime = $currentTime->copy()->subMinutes($this->timeoutMinutes);

        if ($this->getChecksSinceTime($cutoffTime)->count() < $this->checksLimit) {
            return true;
        }

        $latestCheck = $this->lastChecks->max();
        return $this->timeoutMinutes <= $currentTime->diffInMinutes($latestCheck);
    }

    public function update(): self
    {
        $this->lastChecks->push(Carbon::now());
        $this->lastChecks = $this->lastChecks->take(-1 * ($this->checksLimit + 2))->values();

        Setting::setValue($this->settingKey, $this->lastChecks->map(function (Carbon $check) {
            return $check->format($this->dateFormat);
        })->toJson());

        return $this;
    }

    private function getChecksSinceTime(Carbon $time): Collection
    {
        return $this->lastChecks->filter(function (Carbon $check) use ($time) {
            return $check->gt($time);
        });
    }
}

class License
{
    private $licensekey = "";
    private $keydata;
    private $salt = "";
    private $cliExtraLocalKeyDays = 10;
    private $localkeydays = 10;
    private $allowcheckfaildays = 5;
    private $useInternalLicensingMirror = false;
    private $debuglog = [];
    private $lastCurlError;
    private static $clientCount;
    private $timeoutMinutes = 5;
    private $checksLimit = 5;
    const LICENSE_API_VERSION = "1.1";
    const LICENSE_API_HOSTS = ["a.licensing.whmcs.com", "b.licensing.whmcs.com", "c.licensing.whmcs.com", "d.licensing.whmcs.com", "e.licensing.whmcs.com", "f.licensing.whmcs.com"];
    const STAGING_LICENSE_API_HOSTS = ["hou-1.licensing.web.staging.whmcs.com"];
    const UNLICENSED_KEY = "LICENSE-REQUIRED";
    public function checkFile($value)
    {
        if($value !== "a896faf2c31f2acd47b0eda0b3fd6070958f1161") {
            throw new Exception\Fatal("File version mismatch. Please contact support.");
        }
        return $this;
    }
    public function setLicenseKey($licenseKey)
    {
        $this->licensekey = $licenseKey;
        return $this;
    }
    public function setLocalKey($localKey)
    {
        $this->decodeLocal($localKey);
        return $this;
    }
    public function setSalt($version, $hash)
    {
        if(empty($version) || empty($hash)) {
            throw new Exception\License\LicenseError("Unable to generate licensing salt");
        }
        $this->salt = sha1(sprintf("WHMCS%s%s%s", $version, "|-|", $hash));
        return $this;
    }
    public function useInternalValidationMirror()
    {
        $this->useInternalLicensingMirror = true;
        return $this;
    }
    protected function getHosts()
    {
        if($this->useInternalLicensingMirror) {
            return self::STAGING_LICENSE_API_HOSTS;
        }
        return self::LICENSE_API_HOSTS;
    }
    public function getLicenseKey()
    {
        return $this->licensekey;
    }
    protected function getHostDomain()
    {
        $domain = defined("WHMCS_LICENSE_DOMAIN") ? WHMCS_LICENSE_DOMAIN : "";
        if($domain === "-") {
            $domain = "";
        }
        if(empty($domain)) {
            $this->debug("WHMCS_LICENSE_DOMAIN is empty, attempting fallback to SystemURL");
            $systemUrl = \App::getSystemURL();
            if(!empty($systemUrl)) {
                $systemUrlHost = parse_url($systemUrl, PHP_URL_HOST);
                if(!empty($systemUrlHost)) {
                    $domain = $systemUrlHost;
                }
            } else {
                $this->debug("SystemURL is not set, fallback failed");
            }
        }
        if(empty($domain)) {
            throw new Exception\License\MissingServerNameError("Unable to retrieve current server name. Please check PHP/vhost configuration and ensure SERVER_NAME is displaying appropriately via PHP Info.");
        }
        $this->debug("Host Domain: " . $domain);
        $this->hostDomain = $domain; // this line is new

        return $domain;
    }
    protected function getHostIP()
    {
        $ip = defined("WHMCS_LICENSE_IP") ? WHMCS_LICENSE_IP : "";
        $this->debug("Host IP: " . $ip);
        $this->hostIP = $ip; // this line is new
        return $ip;
    }
    protected function getHostDir()
    {
        $directory = defined("WHMCS_LICENSE_DIR") ? WHMCS_LICENSE_DIR : "";
        $this->debug("Host Directory: " . $directory);
        $this->hostDir = $directory; // this line is new
        return $directory;
    }
    private function getSalt()
    {
        return $this->salt;
    }
    protected function isLocalKeyValidToUse()
    {
        $licenseKey = $this->getKeyData("key");
        if(empty($licenseKey) || $licenseKey !== $this->licensekey) {
            throw new Exception\License\LicenseError("License Key Mismatch in Local Key");
        }
        $originalcheckdate = $this->getCheckDate();
        $localmax = Carbon::now()->startOfDay()->addDays(2);
        if($originalcheckdate->gt($localmax)) {
            throw new Exception\License\LicenseError("Original check date is in the future");
        }
    }
    protected function hasLocalKeyExpired()
    {
        $originalCheckDate = $this->getCheckDate();
        $daysBeforeNewCheckIsRequired = $this->localkeydays;
        if($this->isRunningInCLI()) {
            $daysBeforeNewCheckIsRequired += $this->cliExtraLocalKeyDays;
        }
        $localExpiryMax = Carbon::now()->startOfDay()->subDays($daysBeforeNewCheckIsRequired);
        if(!$originalCheckDate || $originalCheckDate->lt($localExpiryMax)) {
            throw new Exception\License\LicenseError("Original check date is outside allowed validity period");
        }
    }
    protected function buildPostData()
    {
        $whmcs = \DI::make("app");
        $systemStats = $whmcs->get_config("SystemStatsCache");
        if(!$systemStats) {
            $systemStats = (new Cron\Task\SystemConfiguration())->generateSystemStats();
            $whmcs->set_config("SystemStatsCache", $systemStats);
        }
        $stats = json_decode($systemStats, true);
        $stats["systemEvents"] = \DI::make("WHMCS\\SystemEvent\\Service\\SystemEventService")->getSystemEventStatistics(true);
        if(!is_array($stats)) {
            $stats = [];
        }
        $components = json_decode($whmcs->get_config("ComponentStatsCache"), true);
        if(!is_array($components)) {
            $components = [];
        }
        $stats["components"] = $components;
        $stats["sitejet"] = (new Utility\Sitejet\SitejetStatsReport())->getStats();
        $stats = array_merge($stats, Environment\Environment::toArray());
        $clientCount = str_replace("=", "", base64_encode($this->getNumberOfActiveClients()));
        $deployment = Utility\Deployment\Deployment::storedOrCreate();
        return ["licensekey" => $this->getLicenseKey(), "domain" => $this->getHostDomain(), "ip" => $this->getHostIP(), "dir" => $this->getHostDir(), "version" => $whmcs->getVersion()->getCanonical(), "phpversion" => PHP_VERSION, "clct" => $clientCount, "anondata" => $this->encryptMemberData($stats), "member" => $this->encryptMemberData($this->buildMemberData()), "check_token" => sha1(time() . $this->getLicenseKey() . random_int(1000000000, PHP_INT_MAX)), "deployment" => ["identifier" => $deployment->identity()->identifier()]];
    }
    public function isUnlicensed()
    {
        return $this->getLicenseKey() === static::UNLICENSED_KEY;
    }
    public function validate($forceRemote = false)
    {
        if(!$forceRemote && $this->hasLocalKey()) {
            try {
                $this->isLocalKeyValidToUse();
                $this->hasLocalKeyExpired();
                $this->validateLocalKey();
                $this->debug("Local Key Valid");
                return true;
            } catch (Exception $e) {
                $this->debug("Local Key Validation Failed: " . $e->getMessage());
            }
        }
        $remoteChecked = false;
        $remoteChecker = $this->remoteCheckManager()->init();
        if($forceRemote || $remoteChecker->shouldCheck()) {
            $remoteChecked = true;
            $remoteChecker->update();
            if($this->remoteLicenseCheck()) {
                return true;
            }
            $this->debug("Remote license check failed. Attempting local key fallback.");
        }
        if($this->localLicenseCheck()) {
            return true;
        }
        $this->debug("Local key is not valid for fallback");
        if($remoteChecked && !is_null($this->lastCurlError)) {
            throw new Exception\License\LicenseError("CURL Error: " . $this->lastCurlError);
        }
        throw new Exception\Http\ConnectionError();
    }
    private function callHomeLoop($query_string, $timeout = 5)
    {
        foreach ($this->getHosts() as $host) {
            try {
                $this->debug("Attempting call home with host: " . $host);
                return $this->makeCall($this->getVerifyUrl($host), $query_string, $timeout);
            } catch (Exception $e) {
                $this->debug("Remote call failed: " . $e->getMessage());
            }
        }
        return false;
    }
    protected function callHome($postfields)
    {
        $this->validateCurlIsAvailable();
        $query_string = build_query_string($postfields);
        $response = $this->callHomeLoop($query_string, 5);
        if($response) {
            return $response;
        }
        return $this->callHomeLoop($query_string, 30);
    }
    private function getVerifyUrl($host)
    {
        return "https://" . $host . "/1.1/verify";
    }
    private function validateCurlIsAvailable()
    {
        $curlFunctions = ["curl_init", "curl_setopt", "curl_exec", "curl_getinfo", "curl_error", "curl_close"];
        foreach ($curlFunctions as $function) {
            if(!Environment\Php::isFunctionAvailable($function)) {
                throw new Exception\License\LicenseError("Required function " . $function . " is not available");
            }
        }
    }
    protected function makeCall($url, $query_string, $timeout = 5)
    {
        $this->debug("Timeout " . $timeout);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $this->useInternalLicensingMirror ? 0 : 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->useInternalLicensingMirror ? 0 : 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "WHMCS/" . \DI::make("app")->getVersion()->getMajor());
        $response = curl_exec($ch);
        $responsecode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if(curl_error($ch)) {
            $this->lastCurlError = curl_error($ch) . " - Code " . curl_errno($ch);
            throw new Exception\License\LicenseError("Curl Error: " . curl_error($ch) . " - Code " . curl_errno($ch));
        }
        curl_close($ch);
        if($responsecode !== 200) {
            throw new Exception\License\LicenseError("Received Non 200 Response Code");
        }
        return $response;
    }
    /*private function processResponse($data)
    {
        $publicServerKey = "-----BEGIN PUBLIC KEY-----\nMIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAy62WXeIR+PG/50quF7HD\nHXxrRkBIjazP19mXmcqRnyB/sXl3v5WDqxkS/bttqEseNgs2+WmuXPdHzwFF2IhY\nqoijl6zvVOXiT44rVQvCvfQrMncWbrl6PmTUmP8Ux2Dmttnz+dGJlTz3uaysfPqC\n9pAn19b8zgNwGPNl0cGqiMxruGU4Vzbbjs0zOamvrzUkpKRkD3t8voW78KqQ80A/\nfyP9jfCa4Tax6OfjiZ2EVMQgwNbu4nZeu5hggg/9KWX62O+iDWRw10A4OIzw2mJ+\nL0IDgeSMdrSUYgHlf+AUeW2qZV7cN7OOdt+FMQ3i5lX9LBBNeykqIiypF+voVFgN\nLhKw04EOrj6R511yOvVIrW5d2FO/wA5mydXJ1T31w+fjG3IitRm9F6tSRoPfeSi9\n+hWMpBUa9rg/BuoSOGoHMKbKFAN2hYu0e2ftkZ7KATNfoSf3D5HEVnTPqx+KfQFT\nRdjsYUIIqVX+GsQzzBulf5YhoTmew+N5n9dZGGbhNHZTr7cMa1DT73BjxOyMr2Fq\nW92QUyodlfZmPMfF+JD+MBMY0r74u8/ow1rCrnqu+3Rr/JE/Hjl6c9VsQS/sucP6\nJQfLTfeBjXNWdrXCvhUb+QaV4pMYxhpno5/7jPEkMOR9o7QTCFzbszEzlotwS/yT\ncgD/Aq302svJj2VbSAtyBi0CAwEAAQ==\n-----END PUBLIC KEY-----";
        $results = $this->parseSignedResponse($data, $publicServerKey);
        $this->debug("Remote license response parsed successfully");
        $results["checkdate"] = Carbon::now()->toDateString();
        if(!empty($results["MemberPubKey"])) {
            $this->setMemberPublicKey($results["MemberPubKey"]);
            unset($results["MemberPubKey"]);
        }
        return $results;
    }*/

    private function processResponse($data)
{
    // Simular una respuesta válida y activa de la licencia.
    $this->debug("Bypassing processResponse. Returning active license response.");
    // Definir el dominio actual y el subdominio "www."
    $hostDomainx = $this->getHostDomain(); // Dominio principal
    $validDomains = "$hostDomainx,www.$hostDomainx"; // Definir la lista de dominios
    
    return [
        "status" => "Active",
        "checkdate" => Carbon::now()->toDateString(),
        "key" => $this->licensekey,
        "registeredname" => "Questions: https://gist.github.com/jesussuarz/0b74fec85031a8e50d2f78187aaa46d3",
        "productname" => "Owned License No Branding",
        "nextduedate" => "2099-08-01",
        "validdomains" => $validDomains, // Asignar el string de dominios
        "validips" => $this->getHostIP(),
        "validdirs" => $this->getHostDir(),
        "ClientLimit" => 1000000,
        "ClientLimitAutoUpgradeEnabled" => 1,
        "supportaccess" => 1,
        "addons" => [array('name' => 'Branding Removal', 'nextduedate' => '2090-08-12', 'status' => 'Active'), array('name' => 'Support and Updates', 'nextduedate' => '2090-08-12', 'status' => 'Active'), array('name' => 'Project Management Addon', 'nextduedate' => '2090-08-12', 'status' => 'Active'), array('name' => 'Licensing Addon', 'nextduedate' => '2090-08-12', 'status' => 'Active'), array('name' => 'Mobile Edition', 'nextduedate' => '2090-08-12', 'status' => 'Active'), array('name' => 'iPhone App', 'nextduedate' => '2090-08-12', 'status' => 'Active'), array('name' => 'Android App', 'nextduedate' => '2090-08-12', 'status' => 'Active'), array('name' => 'Configurable Package Addon', 'nextduedate' => '2090-08-12', 'status' => 'Active'), array('name' => 'Live Chat Monthly No Branding', 'nextduedate' => '2090-08-12', 'status' => 'Active')]
    ];
}
/*
    private function parseSignedResponse($response, $publicKey)
    {
        if($this->useInternalLicensingMirror) {
            $data = json_decode($response, true);
            if(is_null($data) || !is_array($data)) {
                throw new Exception\License\LicenseError("Internal licensing mirror response could not be decoded");
            }
            return $data;
        }
        $data = explode(":", $response, 2);
        if(empty($data[1])) {
            throw new Exception\License\LicenseError("No license signature found");
        }
        $rsa = new \phpseclib\Crypt\RSA();
        $rsa->setSignatureMode(\phpseclib\Crypt\RSA::SIGNATURE_PKCS1);
        $rsa->loadKey(str_replace(["\n", " "], ["", ""], $publicKey));
        try {
            if(!$rsa->verify($data[0], base64_decode($data[1]))) {
                throw new Exception\License\LicenseError("Invalid license signature");
            }
        } catch (\Exception $e) {
            throw new Exception\License\LicenseError("Invalid license signature");
        }
        $data = strrev($data[0]);
        $data = base64_decode($data);
        $data = json_decode($data, true);
        if(empty($data)) {
            throw new Exception\License\LicenseError("Invalid license data structure");
        }
        return $data;
    }
*/
    // NEW
    private function parseSignedResponse($response, $publicKey)
    {
        // Omitir todas las validaciones y verificación de firma, devolver directamente los datos.
        $this->debug("Bypassing signature and verification check. Returning decoded response directly.");

        // Si se está utilizando el 'Licensing Mirror', decodificar directamente.
        if ($this->useInternalLicensingMirror) {
            $data = json_decode($response, true);
            if (is_null($data) || !is_array($data)) {
                throw new Exception\License\LicenseError("Internal licensing mirror response could not be decoded");
            }
            return $data;
        }

        // Omitir validación de firma y decodificar el contenido.
        $data = explode(":", $response, 2);
        if (empty($data[0])) {
            throw new Exception\License\LicenseError("No license data found");
        }

        // Decodificar el contenido sin realizar verificaciones adicionales.
        $data = base64_decode(strrev($data[0]));
        $decodedData = json_decode($data, true);

        // Asegurarse de que los datos sean válidos antes de retornar.
        if (empty($decodedData) || !is_array($decodedData)) {
            throw new Exception\License\LicenseError("Invalid license data structure");
        }

        $this->debug("License response processed successfully without signature validation.");
        return $decodedData;
    }
    private function updateLocalKey($data)
    {
        $data_encoded = json_encode($data);
        $data_encoded = base64_encode($data_encoded);
        $data_encoded = sha1(Carbon::now()->toDateString() . $this->getSalt()) . $data_encoded;
        $data_encoded = strrev($data_encoded);
        $splpt = strlen($data_encoded) / 2;
        $data_encoded = substr($data_encoded, $splpt) . substr($data_encoded, 0, $splpt);
        $data_encoded = sha1($data_encoded . $this->getSalt()) . $data_encoded . sha1($data_encoded . $this->getSalt() . time());
        $data_encoded = base64_encode($data_encoded);
        $data_encoded = wordwrap($data_encoded, 80, "\n", true);
        \App::self()->set_config("License", $data_encoded);
        return $this->debug("Local Key Updated");
    }
    public function forceRemoteCheck()
    {
        return $this->validate(true);
    }
    private function decodeLocal($localkey = "")
    {
        $this->debug("Decoding local key");
        if(!$localkey) {
            $this->debug("No local key provided");
            return false;
        }
        $localkey = str_replace("\n", "", $localkey);
        $localkey = base64_decode($localkey);
        $localdata = substr($localkey, 40, -40);
        $md5hash = substr($localkey, 0, 40);
        if(!hash_equals(sha1($localdata . $this->getSalt()), $md5hash)) {
            $this->debug("Local Key MD5 Hash Invalid");
            return false;
        }
        $splpt = strlen($localdata) / 2;
        $localdata = substr($localdata, $splpt) . substr($localdata, 0, $splpt);
        $localdata = strrev($localdata);
        $md5hash = substr($localdata, 0, 40);
        $localdata = substr($localdata, 40);
        $localdata = base64_decode($localdata);
        $localKeyData = json_decode($localdata, true);
        $originalcheckdate = $localKeyData["checkdate"];
        if(!hash_equals(sha1($originalcheckdate . $this->getSalt()), $md5hash)) {
            $this->debug("Local Key MD5 Hash 2 Invalid");
            return false;
        }
        $this->setKeyData($localKeyData);
        $this->debug("Local Key Decoded Successfully");
        return true;
    }
    protected function isRunningInCLI()
    {
        return Environment\Php::isCli();
    }
    protected function hasLocalKey()
    {
        return !is_null($this->keydata);
    }
    protected function validateLocalKey()
    {
        if($this->getKeyData("status") !== "Active") {
            throw new Exception\License\LicenseError("Local Key Status not Active");
        }
        if($this->isRunningInCLI()) {
            $this->debug("Running in CLI Mode");
        } else {
            $this->debug("Running in Browser Mode");
            if($this->isValidDomain($this->getHostDomain())) {
                $this->debug("Domain Validated Successfully");
                $ip = $this->getHostIP();
                $this->debug("Host IP Address: " . $ip);
                if(!$ip) {
                    $this->debug("IP Could Not Be Determined - Skipping Local Validation of IP");
                } elseif(!trim($this->getKeyData("validips"))) {
                    $this->debug("No Valid IPs returned by license check - Cloud Based License - Skipping Local Validation of IP");
                } elseif($this->isValidIP($ip)) {
                    $this->debug("IP Validated Successfully");
                } else {
                    throw new Exception\License\LicenseError("Invalid IP");
                }
            } else {
                throw new Exception\License\LicenseError("Invalid domain");
            }
        }
        if($this->isValidDir($this->getHostDir())) {
            $this->debug("Directory Validated Successfully");
        } else {
            throw new Exception\License\LicenseError("Invalid directory");
        }
    }
    private function isValidDomain($domain)
    {
        $validdomains = $this->getArrayKeyData("validdomains");
        return in_array($domain, $validdomains);
    }
    private function isValidIP($ip)
    {
        $validips = $this->getArrayKeyData("validips");
        return in_array($ip, $validips);
    }
    private function isValidDir($dir)
    {
        $validdirs = $this->getArrayKeyData("validdirs");
        return in_array($dir, $validdirs);
    }
    public function getBanner()
    {
        $licenseKeyParts = explode("-", $this->getLicenseKey(), 2);
        $prefix = $licenseKeyParts[0] ?? "";
        if(in_array($prefix, ["Dev", "Beta", "Security", "Trial"])) {
            if($prefix === "Beta") {
                $devBannerTitle = "Beta License";
                $devBannerMsg = "This license is intended for beta testing only and should not be used in a production environment. Please report any cases of abuse to abuse@whmcs.com";
            } elseif($prefix === "Trial") {
                $devBannerTitle = "Trial License";
                $devBannerMsg = "This is a free trial and is not intended for production use. Please <a href=\"https://www.whmcs.com/order/\" target=\"_blank\">purchase a license</a> to remove this notice.";
            } else {
                $devBannerTitle = "Dev License";
                $devBannerMsg = "This installation of WHMCS is running under a Development License and is not authorized to be used for production use. Please report any cases of abuse to abuse@whmcs.com";
            }
            return "<strong>" . $devBannerTitle . ":</strong> " . $devBannerMsg;
        }
        return "";
    }
    public function isDevLicense() : bool
    {
        $devLicensePrefixes = ["Internal", "Dev"];
        $licenseKeyParts = explode("-", $this->getLicenseKey(), 2);
        $licenseKeyPrefix = $licenseKeyParts[0] ?? "";
        return in_array($licenseKeyPrefix, $devLicensePrefixes);
    }
    private function revokeLocal()
    {
        \App::self()->set_config("License", "");
    }
    public function getKeyData($var)
    {
        return isset($this->keydata[$var]) ? $this->keydata[$var] : "";
    }
    private function setKeyData($data)
    {
        $this->keydata = $data;
        return $this;
    }
    protected function getArrayKeyData($var)
    {
        $listData = [];
        $rawData = $this->getKeyData($var);
        if(is_string($rawData)) {
            $listData = explode(",", $rawData);
            foreach ($listData as $k => $v) {
                if(is_string($v)) {
                    $listData[$k] = trim($v);
                } else {
                    throw new Exception\License\LicenseError("Invalid license data structure");
                }
            }
        } elseif(!is_null($rawData)) {
            throw new Exception\License\LicenseError("Invalid license data structure");
        }
        return $listData;
    }
    public function getRegisteredName()
    {
        return $this->getKeyData("registeredname");
    }
    public function getProductName()
    {
        return $this->getKeyData("productname");
    }
    public function getStatus()
    {
        return $this->getKeyData("status");
    }
    public function isActive() : bool
    {
        return $this->getStatus() === "Active";
    }
    public function getSupportAccess()
    {
        return $this->getKeyData("supportaccess");
    }
    public function getRegistrationDate()
    {
        return $this->getKeyData("regdate");
    }
    protected function getCheckDate()
    {
        $checkDate = $this->getKeyData("checkdate");
        if(empty($checkDate)) {
            return false;
        }
        return Carbon::createFromFormat("Y-m-d", $checkDate);
    }
    protected function getLicensedAddons()
    {
        $licensedAddons = $this->getKeyData("addons");
        if(!is_array($licensedAddons)) {
            $licensedAddons = [];
        }
        return $licensedAddons;
    }
    public function getActiveAddons()
    {
        $licensedAddons = $this->getLicensedAddons();
        $activeAddons = [];
        foreach ($licensedAddons as $addon) {
            if($addon["status"] === "Active") {
                $activeAddons[] = $addon["name"];
            }
        }
        return $activeAddons;
    }
    public function isActiveAddon($addon)
    {
        return (bool) in_array($addon, $this->getActiveAddons());
    }
    public function getExpiryDate($showday = false)
    {
        $expiry = $this->getKeyData("nextduedate");
        if(!$expiry) {
            $expiry = "Never";
        } elseif($showday) {
            $expiry = date("l, jS F Y", strtotime($expiry));
        } else {
            $expiry = date("jS F Y", strtotime($expiry));
        }
        return $expiry;
    }
    public function getLatestPublicVersion()
    {
        try {
            $latestVersion = new Version\SemanticVersion($this->getKeyData("latestpublicversion"));
        } catch (Exception\Version\BadVersionNumber $e) {
            $whmcs = \DI::make("app");
            $latestVersion = $whmcs->getVersion();
        }
        return $latestVersion;
    }
    public function getLatestPreReleaseVersion()
    {
        try {
            $latestVersion = new Version\SemanticVersion($this->getKeyData("latestprereleaseversion"));
        } catch (Exception\Version\BadVersionNumber $e) {
            $whmcs = \DI::make("app");
            $latestVersion = $whmcs->getVersion();
        }
        return $latestVersion;
    }
    public function getLatestVersion()
    {
        $whmcs = \DI::make("app");
        $installedVersion = $whmcs->getVersion();
        if(in_array($installedVersion->getPreReleaseIdentifier(), ["beta", "rc"])) {
            $latestVersion = $this->getLatestPreReleaseVersion();
        } else {
            $latestVersion = $this->getLatestPublicVersion();
        }
        return $latestVersion;
    }
    public function isUpdateAvailable()
    {
        $whmcs = \DI::make("app");
        $installedVersion = $whmcs->getVersion();
        $latestVersion = $this->getLatestVersion();
        return Version\SemanticVersion::compare($latestVersion, $installedVersion, ">");
    }
    public function getRequiresUpdates()
    {
        return $this->getKeyData("requiresupdates") ? true : false;
    }
    public function getUpdatesExpirationDate()
    {
        $expirationDates = [];
        $licensedAddons = $this->getLicensedAddons();
        foreach ($licensedAddons as $addon) {
            if($addon["name"] === "Support and Updates" && $addon["status"] === "Active" && isset($addon["nextduedate"])) {
                try {
                    $expirationDates[] = Carbon::createFromFormat("Y-m-d", $addon["nextduedate"]);
                } catch (\Exception $e) {
                }
            }
        }
        if(!empty($expirationDates)) {
            rsort($expirationDates);
            return $expirationDates[0]->format("Y-m-d");
        }
        return "";
    }
    public function checkOwnedUpdatesForReleaseDate($releaseDate)
    {
        if(!$this->getRequiresUpdates()) {
            return true;
        }
        try {
            $updatesExpirationDate = Carbon::createFromFormat("Y-m-d", $this->getUpdatesExpirationDate());
            $checkDate = Carbon::createFromFormat("Y-m-d", $releaseDate);
            return $checkDate <= $updatesExpirationDate;
        } catch (\Exception $e) {
        }
        return false;
    }
    public function checkOwnedUpdates()
    {
        $whmcs = \DI::make("app");
        $isLicenseValidForVersion = $this->checkOwnedUpdatesForReleaseDate($whmcs->getReleaseDate());
        if(!$isLicenseValidForVersion) {
            try {
                $this->forceRemoteCheck();
                $isLicenseValidForVersion = $this->checkOwnedUpdatesForReleaseDate($whmcs->getReleaseDate());
            } catch (\Exception $e) {
            }
        }
        return $isLicenseValidForVersion;
    }
    public function getBrandingRemoval()
    {
        if(in_array($this->getProductName(), ["Owned License No Branding", "Monthly Lease No Branding"])) {
            return true;
        }
        $licensedAddons = $this->getLicensedAddons();
        foreach ($licensedAddons as $addon) {
            if($addon["name"] === "Branding Removal" && $addon["status"] === "Active") {
                return true;
            }
        }
        return false;
    }
    private function debug($msg)
    {
        $this->debuglog[] = $msg;
        return $this;
    }
    public function getDebugLog()
    {
        return $this->debuglog;
    }
    public function getUpdateValidityDate()
    {
        return new \DateTime();
    }
    public function isClientLimitsEnabled()
    {
        return (bool) $this->getKeyData("ClientLimitsEnabled");
    }
 /*   public function getClientLimit() : int
    {
        $clientLimit = $this->getKeyData("ClientLimit");
        if(empty($clientLimit)) {
            return -1;
        }
        if(!is_numeric($clientLimit)) {
            $this->debug("Invalid client limit value in license");
            return 0;
        }
        return (int) $clientLimit;
    } */

      // NEW
       public function getClientLimit() : int
       {
           $clientLimit = $this->getKeyData("ClientLimit");
       
           // Si no se encuentra el valor o está vacío, retornamos un número grande indicando "clientes ilimitados"
           if (empty($clientLimit)) {
               return PHP_INT_MAX; // Número máximo de entero en PHP (indica ilimitado)
           }
       
           // Si el valor no es numérico, registramos el error y devolvemos un número grande indicando "clientes ilimitados"
           if (!is_numeric($clientLimit)) {
               $this->debug("Invalid client limit value in license");
               return PHP_INT_MAX; // Valor alto como límite ficticio para clientes ilimitados
           }
       
           // Devolver el límite de clientes como número entero. Si es 0, retornamos también ilimitado.
           return (int) $clientLimit === 0 ? PHP_INT_MAX : (int) $clientLimit;
       }
           
    public function getTextClientLimit()
    {
        $clientLimit = $this->getClientLimit();
        $fallbackTranslation = "Unlimited";
        if(0 < $clientLimit) {
            $result = number_format($clientLimit, 0, "", ",");
        } else {
            $translationKey = "global.unlimited";
            $result = \AdminLang::trans($translationKey);
            if($result === $translationKey) {
                $result = $fallbackTranslation;
            }
        }
        return $result;
    }
    public function getNumberOfActiveClients() : int
    {
        if(is_null(self::$clientCount)) {
            self::$clientCount = (int) get_query_val("tblclients", "count(id)", "status='Active'");
        }
        return self::$clientCount;
    }
    public function getTextNumberOfActiveClients(Admin $admin = NULL)
    {
        $clientLimit = $this->getNumberOfActiveClients();
        $result = "None";
        if(0 < $clientLimit) {
            $result = number_format($clientLimit, 0, "", ",");
        } elseif($admin && ($text = $admin->lang("global", "none"))) {
            $result = $text;
        }
        return $result;
    }
    public function getClientBoundaryId()
    {
        $clientLimit = $this->getClientLimit();
        if($clientLimit < 0) {
            return 0;
        }
        return (int) get_query_val("tblclients", "id", "status='Active'", "id", "ASC", (int) $clientLimit . ",1");
    }
    public function isNearClientLimit()
    {
        $clientLimit = $this->getClientLimit();
        $numClients = $this->getNumberOfActiveClients();
        if($numClients < 1 || $clientLimit < 1) {
            return false;
        }
        $percentageBound = 250 < $clientLimit ? 0 : 0;
        return $clientLimit * (1 - $percentageBound) <= $numClients;
    }
    public function isClientLimitsAutoUpgradeEnabled()
    {
        return (bool) $this->getKeyData("ClientLimitAutoUpgradeEnabled");
    }
    public function getClientLimitLearnMoreUrl()
    {
        return $this->getKeyData("ClientLimitLearnMoreUrl");
    }
    public function getClientLimitUpgradeUrl()
    {
        return $this->getKeyData("ClientLimitUpgradeUrl");
    }
    protected function getMemberPublicKey()
    {
        $publicKey = Config\Setting::getValue("MemberPubKey");
        if($publicKey) {
            $publicKey = decrypt($publicKey);
        }
        return $publicKey;
    }
    protected function setMemberPublicKey($publicKey = "")
    {
        if($publicKey) {
            $publicKey = encrypt($publicKey);
            Config\Setting::setValue("MemberPubKey", $publicKey);
        }
        return $this;
    }
    public function encryptMemberData(array $data = [])
    {
        $publicKey = $this->getMemberPublicKey();
        if(!$publicKey) {
            return "";
        }
        $publicKey = str_replace(["\n", "\r", " "], ["", "", ""], $publicKey);
        $cipherText = "";
        if(is_array($data)) {
            try {
                $rsa = new \phpseclib\Crypt\RSA();
                $rsa->loadKey($publicKey);
                $rsa->setEncryptionMode(\phpseclib\Crypt\RSA::ENCRYPTION_OAEP);
                $cipherText = $rsa->encrypt(json_encode($data));
                if(!$cipherText) {
                    throw new Exception\License\LicenseError("Could not perform RSA encryption");
                }
                $cipherText = base64_encode($cipherText);
            } catch (\Exception $e) {
                $this->debug("Failed to encrypt member data");
            }
        }
        return $cipherText;
    }
    public function getClientLimitNotificationAttributes() : array
    {
        if(!$this->isClientLimitsEnabled() || !$this->isNearClientLimit()) {
            //return NULL;
           return [];
        }
        $clientLimit = $this->getClientLimit();
        $clientLimitNotification = ["class" => "info", "icon" => "fa-info-circle", "title" => "Approaching Client Limit", "body" => "You are approaching the maximum number of clients permitted by your current license. Your license will be upgraded automatically when the limit is reached.", "autoUpgradeEnabled" => $this->isClientLimitsAutoUpgradeEnabled(), "upgradeUrl" => $this->getClientLimitUpgradeUrl(), "learnMoreUrl" => $this->getClientLimitLearnMoreUrl(), "numberOfActiveClients" => $this->getNumberOfActiveClients(), "clientLimit" => $clientLimit];
        if($this->isClientLimitsAutoUpgradeEnabled()) {
            if($this->getNumberOfActiveClients() < $clientLimit) {
            } elseif($clientLimit === $this->getNumberOfActiveClients()) {
                $clientLimitNotification["title"] = "Client Limit Reached";
                $clientLimitNotification["body"] = "You have reached the maximum number of clients permitted by your current license. Your license will be upgraded automatically when the next client is created.";
            } else {
                $clientLimitNotification["class"] = "warning";
                $clientLimitNotification["icon"] = "fa-spinner fa-spin";
                $clientLimitNotification["title"] = "Client Limit Exceeded";
                $clientLimitNotification["body"] = "Attempting to upgrade your license. Communicating with license server...";
                $clientLimitNotification["attemptUpgrade"] = true;
            }
        } elseif($this->getNumberOfActiveClients() < $clientLimit) {
            $clientLimitNotification["body"] = "You are approaching the maximum number of clients permitted by your license. As you have opted out of automatic license upgrades, you should upgrade now to avoid interuption in service.";
        } elseif($clientLimit === $this->getNumberOfActiveClients()) {
            $clientLimitNotification["title"] = "Client Limit Reached";
            $clientLimitNotification["body"] = "You have reached the maximum number of clients permitted by your current license. As you have opted out of automatic license upgrades, you must upgrade now to avoid interuption in service.";
        } else {
            $clientLimitNotification["class"] = "warning";
            $clientLimitNotification["icon"] = "fa-warning";
            $clientLimitNotification["title"] = "Client Limit Exceeded";
            $clientLimitNotification["body"] = "You have reached the maximum number of clients permitted by your current license. As automatic license upgrades have been disabled, you must upgrade now.";
        }
        return $clientLimitNotification;
    }
    protected function buildMemberData()
    {
        return ["licenseKey" => $this->getLicenseKey(), "activeClientCount" => $this->getNumberOfActiveClients()];
    }
    public function getEncryptedMemberData()
    {
        return $this->encryptMemberData($this->buildMemberData());
    }
    protected function getUpgradeUrl($host)
    {
        return "https://" . $host . "/" . self::LICENSE_API_VERSION . "/upgrade";
    }
    public function makeUpgradeCall()
    {
        $checkToken = sha1(time() . $this->getLicenseKey() . random_int(1000000000, PHP_INT_MAX));
        $query_string = build_query_string(["check_token" => $checkToken, "license_key" => $this->getLicenseKey(), "member_data" => $this->encryptMemberData($this->buildMemberData())]);
        $timeout = 30;
        foreach ($this->getHosts() as $host) {
            try {
                $response = $this->makeCall($this->getUpgradeUrl($host), $query_string, $timeout);
                $data = $this->processResponse($response);
                if(!$this->isHashValid($checkToken, $data["hash"])) {
                    return false;
                }
                if($data["status"] === "Success" && is_array($data["new"])) {
                    unset($data["status"]);
                    $this->keydata = array_merge($this->keydata, $data["new"]);
                    $this->updateLocalKey($this->keydata);
                    return true;
                }
                return false;
            } catch (Exception $e) {
            }
        }
        return false;
    }
    public function isValidLicenseKey($licenseKey)
    {
        if(is_string($licenseKey) || is_numeric($licenseKey)) {
            $pattern = "/^[0-9a-zA-Z\\-_]{10,}\$/";
            return (bool) preg_match($pattern, $licenseKey);
        }
        return false;
    }
    private function getWhmcsNetKey()
    {
        $key = $this->getKeyData("whmcsnetkey");
        if(!$key) {
            $key = "f4e0cdeba94d4fd5377d20d895ee5600dfc03776";
        }
        return $key;
    }
    public function hashMessage($value)
    {
        $hashKey = $this->getWhmcsNetKey();
        $obfuscatedLicenseKey = sha1($this->getLicenseKey());
        $hashable = $obfuscatedLicenseKey . $value . $hashKey;
        $hmac = hash_hmac("sha256", $hashable, $hashKey);
        return $obfuscatedLicenseKey . "|" . $value . "|" . $hmac;
    }
    public function getValueFromHashMessage($message)
    {
        if(!$this->isValidHashMessage($message)) {
            return NULL;
        }
        $parts = explode("|", $message);
        return $parts[1];
    }
    public function isValidHashMessage($message)
    {
        $parts = explode("|", $message);
        if(count($parts) < 3) {
            return false;
        }
        $hashKey = $this->getWhmcsNetKey();
        $obfuscatedLicenseKey = array_shift($parts);
        $hmacGiven = array_pop($parts);
        $hashable = $obfuscatedLicenseKey . implode("", $parts) . $hashKey;
        $hmacCalculated = hash_hmac("sha256", $hashable, $hashKey);
        return (bool) hash_equals($hmacCalculated, $hmacGiven);
    }
    private function remoteCheckManager()
    {
        //return new func_num_args($this->timeoutMinutes, $this->checksLimit);
		return new RemoteCheckManager($this->timeoutMinutes, $this->checksLimit);

    }
    private function remoteLicenseCheck() : bool
    {
        $postfields = $this->buildPostData();
        $response = $this->callHome($postfields);
        if($response === false && !is_null($this->lastCurlError)) {
            $this->debug("CURL Error: " . $this->lastCurlError);
        }
        if(!Environment\Php::isFunctionAvailable("base64_decode")) {
            throw new Exception\License\LicenseError("Required function base64_decode is not available");
        }
        if($response !== false) {
            try {
                $results = $this->processResponse($response);
                /*if(!$this->isHashValid($postfields["check_token"], $results["hash"])) {
                    throw new Exception\License\LicenseError("Invalid hash check token");
                }*/
                $this->setKeyData($results)->updateLocalKey($results)->updateDeployment()->debug("Remote license check successful");
                return true;
            } catch (Exception $e) {
                $this->debug("Failed parsing remote license response: " . $e->getMessage());
            }
        }
        return false;
    }
    private function localLicenseCheck() : bool
    {
        if($this->hasLocalKey()) {
            try {
                $this->isLocalKeyValidToUse();
                $this->validateLocalKey();
                $checkDate = $this->getCheckDate();
                $localMaxExpiryDate = Carbon::now()->startOfDay()->subDays($this->localkeydays + $this->allowcheckfaildays);
                if($checkDate && $checkDate->gt($localMaxExpiryDate)) {
                    $this->debug("Local key is valid for fallback");
                    return true;
                }
                $this->debug("Local key is too old for fallback");
            } catch (Exception $e) {
                $this->debug("Local Key Validation Failed: " . $e->getMessage());
            }
        }
        return false;
    }
    private function isHashValid($token, string $hash) : bool
    {
        return hash_equals(sha1("WHMCSV5.2SYH" . $token), $hash);
    }
    //private function updateDeployment() : \self
	private function updateDeployment() : self
    {
        $deployment = Utility\Deployment\Deployment::storedOrNew();
        if(!$this->isActive()) {
            $deployment->authorization()->nullify();
            $deployment->save();
            return $this;
        }
        $licenseDeploymentData = $this->getKeyData("deployment");
        if(!is_array($licenseDeploymentData) || !isset($licenseDeploymentData["authorization"])) {
            return $this;
        }
        $key = $licenseDeploymentData["authorization"]["key"] ?? "";
        $schema = $licenseDeploymentData["authorization"]["schema"] ?? "";
        $deployment->authorization()->withKey($key)->withSchema($schema);
        $deployment->save();
        return $this;
    }
}
/*
// Reemplaza esto:
WHMCS\Carbon::now();

// Por esto:
Carbon::now();
*/

?>