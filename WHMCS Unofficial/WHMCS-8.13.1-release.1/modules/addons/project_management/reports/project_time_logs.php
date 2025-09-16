<?php

use Illuminate\Database\Query\Builder;
use WHMCS\Carbon;
use WHMCS\Database\Capsule;
use WHMCS\User\Admin;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

$reportdata["title"] = "Project Management Project Time Logs";
$reportdata["description"] = "This report shows the amount of time logged on a per task basis, per staff member, for a given date range.";
$reportdata['headertext'] = '';
$reportdata["tableheadings"] = array(
    "Project Name",
    "Task Name",
    "Total Time"
);
$reportdata["tablevalues"] = [];

$range = App::getFromRequest('range');
$staffId = App::getFromRequest('staffid');

if (!$range) {
    $today = Carbon::today()->endOfDay();
    $lastWeek = Carbon::today()->subDays(6)->startOfDay();
    $range = $lastWeek->toAdminDateFormat() . ' - ' . $today->toAdminDateFormat();
}

$unassignedSelected = ($staffId == 'unassigned') ? ' selected="selected"' : '';
$staffDropdown = '';
foreach (Admin::all() as $admin) {
    $selected = ($admin->id == $staffId) ? ' selected="selected"' : '';
    $staffDropdown .= "<option value=\"{$admin->id}\"{$selected}>{$admin->fullName}</option>";
}

if (!App::getFromRequest('print')) {
    $reportdata['headertext'] = <<<HTML
<form method="post" action="{$requeststr}">
    <div class="report-filters-wrapper">
        <div class="inner-container">
            <h3>Filters</h3>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="inputFilterDate">{$dateRangeText}</label>
                        <div class="form-group date-picker-prepend-icon">
                            <label for="inputFilterDate" class="field-icon">
                                <i class="fal fa-calendar-alt"></i>
                            </label>
                            <input id="inputFilterDate"
                                   type="text"
                                   name="range"
                                   value="{$range}"
                                   class="form-control date-picker-search"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="inputFilterStaff">Staff Member</label>
                        <select id="inputFilterStaff" name="staffid" class="form-control">
                            <option value="any">- Any -</option>
                            <option value="unassigned"{$unassignedSelected}>- Unassigned -</option>
                            {$staffDropdown}
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                {$aInt->lang('reports', 'generateReport')}
            </button>
        </div>
    </div>
</form>
HTML;
}

$dateRange = Carbon::parseDateRangeValue($range);
$datefrom = $dateRange['from']->timestamp;
$dateto = $dateRange['to']->timestamp;
$totalDuration = 0;
$prevStaff = $prevProject = null;

$projectData = Capsule::table('mod_projecttimes')
    ->join('mod_project', 'mod_project.id', '=', 'mod_projecttimes.projectid')
    ->leftjoin('mod_projecttasks', 'mod_projecttasks.id', '=', 'mod_projecttimes.taskid')
    ->where(function (Builder $query) use ($datefrom, $dateto) {
        return $query->where(
            [
                ['mod_projecttimes.start', '>=', $datefrom],
                ['mod_projecttimes.end', '<=', $dateto],
                ['mod_projecttimes.end', '!=', ''],
            ]
        );
    })
    ->when(is_numeric($staffId), function (Builder $query) use ($staffId) {
        return $query->where('mod_projecttimes.adminid', $staffId);
    })
    ->when(($staffId == 'unassigned'), function (Builder $query) {
        return $query->where('mod_projecttimes.adminid', 0);
    })
    ->select(
        'mod_project.id',
        'mod_projecttimes.adminid',
        'mod_projecttimes.projectid',
        'mod_projecttimes.taskid',
        'mod_project.title',
        'mod_project.created',
        'mod_project.duedate',
        'mod_projecttasks.task'
    )
    ->selectRaw("SUM(mod_projecttimes.end - mod_projecttimes.start) as time")
    ->groupBy(['mod_projecttimes.adminid', 'mod_projecttimes.projectid', 'mod_projecttimes.taskid'])
    ->orderBy('mod_projecttimes.adminid', 'ASC')
    ->orderBy('mod_projecttimes.projectid', 'ASC')
    ->get();

foreach ($projectData as $data) {
    $projectId = $data->id;
    $projectTitle = $data->title;
    $taskTitle = $data->task;
    $projectCreated = $data->created;
    $projectDueDate = $data->duedate;

    if ($projectCreated != '0000-00-00') {
        $projectCreated = Carbon::createFromFormat('Y-m-d', $projectCreated)
            ->toAdminDateFormat();
    }
    if ($projectDueDate != '0000-00-00') {
        $projectDueDate = Carbon::createFromFormat('Y-m-d', $projectDueDate)
            ->toAdminDateFormat();
    }
    if ($projectDueDate == '0000-00-00') {
        $projectDueDate = 'N/A';
    }

    if ($prevStaff !== $data->adminid) {
        if ($prevStaff != null) {
            $reportdata["tablevalues"][] = [
                '',
                '',
                '<strong>' . project_management_format_duration($totalDuration) . '</strong>'
            ];
            $totalDuration = 0;
            $prevProject = null;
        }

        $fullName = ($data->adminid) ? getAdminName($data->adminid) : "Unassigned";
        $reportdata["tablevalues"][] = ["**<strong>{$fullName}</strong>"];
        $prevStaff = $data->adminid;
    }

    if ($prevProject !== $projectId) {
        if ($prevProject != null) {
            $reportdata["tablevalues"][] = [
                '',
                '',
                '<strong>' . project_management_format_duration($totalDuration) . '</strong>'
            ];
            $totalDuration = 0;
        }

        $fmtString = '<a href="addonmodules.php?module=project_management&m=view&projectid=%s">%s</a>'
            . '&nbsp;<span>(Created: %s Due: %s)</span>';

        $projectHead = sprintf(
            $fmtString,
            $projectId,
            $projectTitle,
            $projectCreated,
            $projectDueDate
        );
        $reportdata["tablevalues"][] = ["+*{$projectHead}"];

        $prevProject = $projectId;
    }

    $totalDuration += $data->time;

    $reportdata["tablevalues"][] = [
        '',
        ($taskTitle ?? "Unassigned"),
        project_management_format_duration($data->time)
    ];
}

$reportdata["tablevalues"][] = [
    '',
    '',
    '<strong>' . project_management_format_duration($totalDuration) . '</strong>'
];

function project_management_format_duration(int $sec, $padHours = false): string
{
    if ($sec <= 0) {
        $sec = 0;
    }
    $hms = "";
    $hours = intval(intval($sec) / 3600);
    $hms .= ($padHours) ? str_pad($hours, 2, "0", STR_PAD_LEFT). ":" : $hours. ":";
    $minutes = intval(($sec / 60) % 60);
    $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ":";
    $seconds = intval($sec % 60);
    $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);

    return $hms;
}
