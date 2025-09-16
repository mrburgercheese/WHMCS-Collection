var blendSidebar = {
    refs: {
        sidebar: '#sidebar',
        content: '#contentarea',
        opener: '#sidebarOpener',
        closer: '#sidebarClose',
        collapse: '.sidebar-collapse',
        collapseExpand: '#sidebarCollapseExpand',
    },

    init: function() {
        var self = blendSidebar;

        $(self.refs.opener).click(function(e) {
            e.preventDefault();
            $(this).fadeOut();
            $(self.refs.content).removeClass('sidebar-minimized');
            $(self.refs.sidebar).delay(400).fadeIn('fast');
            WHMCS.http.jqClient.post(whmcsBaseUrl + adminBaseRoutePath + "/search.php","a=maxsidebar");
        });

        $(self.refs.closer).click(function(e) {
            e.preventDefault();
            $(self.refs.sidebar).fadeOut('fast',function(){
                $(self.refs.content).addClass('sidebar-minimized');
                $(self.refs.opener).fadeIn();
            });
            WHMCS.http.jqClient.post(whmcsBaseUrl + adminBaseRoutePath + "/search.php","a=minsidebar");
        });

        $(self.refs.collapseExpand).click(function(e) {
            e.preventDefault();
            $(this).toggleClass('expanded');
            $(self.refs.collapse).slideToggle();
        });
    }
};

$(document).ready(blendSidebar.init);
