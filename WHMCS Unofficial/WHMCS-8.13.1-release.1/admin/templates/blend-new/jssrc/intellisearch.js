var blendIntelliSearch = {
    activeSearch: false,
    typingTimer: null,
    refs: {
        body: 'body',
        form: '#intelliSearchForm',
        value: '#inputIntelliSearchValue',
        close: '#btnIntelliSearchClose',
        results: '#intelligentSearchResults',
        searchResults: '#intelligentSearchResults .search-results',
        resultheadings: '#intelligentSearchResults h5',
        expand: '#intelliSearchExpand',
        realtime: '#intelliSearchRealtime',
        hideinactive: '#intelliSearchHideInactiveSwitch',
        expandbtn: '#intelligentSearchResults .search-more-results',
        searchMoreTpl: '.search-more-results[data-type="placeholder"]',
    },

    init: function () {
        var self = blendIntelliSearch;
        $(self.refs.value).focus(function (e) {
            self.inputExpand();
        });

        $(self.refs.value).keyup(function () {
            self.inputKeyUp();
        });

        $(self.refs.form + ' form').submit(function (e) {
            e.preventDefault();
            self.search();
        });

        $(document).keyup(function (e) {
            if (e.keyCode === 27 && $('#intelliSearchForm').hasClass('active')) {
                self.close();
            }
        });

        $(self.refs.body).click(function (e) {
            if ($(self.refs.form).hasClass('active') && !$(e.target).closest(self.refs.form + ',' + self.refs.results).length) {
                self.close();
            }
        });

        $(self.refs.close).click(function (e) {
            self.close();
        });

        $(self.refs.realtime).bootstrapSwitch()
            .on('switchChange.bootstrapSwitch', function (event, state) {
                WHMCS.http.jqClient.post($(this).data('url'), 'token=' + csrfToken + '&autosearch=' + state);
            });

        $(self.refs.hideinactive).bootstrapSwitch()
            .on('switchChange.bootstrapSwitch', function (event, state) {
                var valueOfField = state ? 1 : 0;
                $('#intelliSearchHideInactive').attr('value', valueOfField);
                self.search();
            });

        $(self.refs.resultheadings).click(function (e) {
            self.toggleResultSet($(this));
        });

        $(blendIntelliSearch.refs.results + ' .collapse-toggle').click(function (e) {
            e.preventDefault();
            blendIntelliSearch.toggleAllResultSets();
        });

        $(document).on('click', blendIntelliSearch.refs.expandbtn, function (e) {
            e.preventDefault();
            blendIntelliSearch.expandResults($(this), $(this).data('type'));
        });
    },
    inputExpand: function () {
        $('#intelliSearchForm').addClass('active')

        var $form = $(this.refs.form);
        if ($form.data('expanded')) {
            return;
        }

        var $targetOffset = $form.offset();

        $targetOffset.left -= 100;

        $form
            .data('expanded', true)
            .data('leftpos', $targetOffset.left)


        if ($(this.refs.value).val()) {
            $(this.refs.results).slideDown();
        }
    },
    inputKeyUp: function () {
        clearTimeout(this.typingTimer);
        if ($(this.refs.value).val().replace(/\s/g, '').length >= 3 && $('#intelliSearchRealtime').is(':checked')) {
            this.typingTimer = setTimeout(this.search, 750);
        }
    },
    showLoader: function () {
        $(this.refs.form).find('.loader').removeClass('fa-search')
            .addClass('fa-spinner fa-spin');
    },
    endLoader: function () {
        $(this.refs.form).find('.loader').addClass('fa-search')
            .removeClass('fa-spinner fa-spin');
    },
    resetResults: function () {
        $(this.refs.searchResults)
            .find('h5').hide().end()
            .find('ul li:not(.template)').remove().end()
            .find('.search-more-results').remove();
    },
    getResultTypes: function () {
        var types = [];
        $('.search-results ul').each(function (index) {
            types.push($(this).data('type'));
        });
        return types;
    },
    getResultTarget: function (type) {
        return $(this.refs.searchResults + ' ul[data-type="' + type + '"]');
    },
    getNumResults: function (type) {
        return this.getResultTarget(type).find('li:not(.template)').length;
    },
    getTotalResults: function () {
        var $target = $(this.refs.searchResults + ' ul');
        return $target.find('li:not(.template)').length;
    },
    getTemplateByType: function (type) {
        var template = this.getResultTarget(type).find('li.template').clone();
        template.removeClass('template');
        return template;
    },
    renderResults: function (type, data) {
        if (data.length == 0) {
            return;
        }
        var template = this.getTemplateByType(type);
        $.each(data, function (index, result) {
            if (typeof result === 'string') {
                obj = '<li>' + result + '</li>';
            } else {
                var obj = blendIntelliSearch.mergeResultData(template.clone(), result);
            }
            blendIntelliSearch.addResult(type, obj);
        });
        var numResults = this.getNumResults(type);
        this.getResultTarget(type).prev('h5').show().find('.count').html(numResults);
        if (data[0].totalResults > numResults) {
            var remainingResults = data[0].totalResults - numResults;
            this.showExpand(type, remainingResults);
        }
    },
    showExpand: function (type, remainingResults) {
        var showMoreOf = $(this.refs.expand).val();
        if (showMoreOf == type) {
            return;
        }

        cloneRow = $(this.refs.searchMoreTpl).clone();
        cloneRow.attr('data-type', type);
        cloneRow.removeClass('hidden');
        stringValue = cloneRow.html();
        stringValue = stringValue.replace(':count', remainingResults);
        cloneRow.html(stringValue);
        this.addResult(type, cloneRow);
    },
    addResult: function (type, obj) {
        this.getResultTarget(type).append(obj);
    },
    mergeResultData: function (result, data) {
        str = result.html();
        $.each(data, function (key, value) {
            str = str.replace(new RegExp('\\[' + key + '\\]', 'g'), value);
        });
        return result.html(str);
    },
    search: function (expandType) {
        var self = blendIntelliSearch;

        if (self.activeSearch) {
            return;
        }
        self.activeSearch = true;

        self.showLoader();

        if (!$(self.refs.results).is(':visible')) {
            $(self.refs.results).slideDown();
        }

        $(self.refs.expand).val(expandType);
        WHMCS.http.jqClient.jsonPost({
            url: $(self.refs.form + ' form').attr('action'),
            data: $(self.refs.form + ' form').serialize(),
            success: function (results) {
                var showMoreOf = $(self.refs.expand).val();
                if (!showMoreOf) {
                    self.resetResults();
                }

                $.each(self.getResultTypes(), function (index, type) {
                    self.renderResults(type, results[type]);
                });

                self.searchComplete(true);
            },
            warning: function (warningMsg) {
                $(self.refs.results).find('.search-warning')
                    .find('.warning-msg').html(warningMsg);
                self.searchComplete(false, '.search-warning');
            },
            error: function (errorMsg) {
                self.searchComplete(false, '.error');
            },
            fail: function (failMsg) {
                self.searchComplete(false, '.session-expired');
            }
        });
    },
    searchComplete: function (success, revealSelector) {
        if (success) {
            var $numSearchResults = this.getTotalResults();
            $(this.refs.results).find('.search-result-count').html($numSearchResults);
            if ($numSearchResults === 0) {
                revealSelector = '.search-no-results';
            } else {
                revealSelector = '.search-results';
            }
        }

        $(this.refs.results).find('.outcome').not(revealSelector).hide();

        if (!$(this.refs.results).find(revealSelector).is(':visible')) {
            $(this.refs.results).find(revealSelector).fadeIn();
        }

        this.endLoader();

        this.activeSearch = false;
    },
    expandResults: function (target, type) {
        target.remove();
        this.search(type);
    },
    close: function () {
        $('#intelliSearchForm').removeClass('active');

        var $form = $(this.refs.form);
        $(this.refs.results).slideUp();
        $form.css({
            width: '',
            left: $(this.refs.form).data('leftpos')
        }).removeClass('active full-width').delay(100).queue(function (next) {
            $form.css({
                position: '',
                top: '',
                left: ''
            });
            next();
        }).data('expanded', false);
        $('.logo').focus();
        clearTimeout(this.typingTimer);
    },
    toggleResultSet: function (el) {
        var list = el.next('ul');
        if (list.is(':visible')) {
            list.slideUp();
            el.addClass('collapsed');
        } else {
            list.slideDown();
            el.removeClass('collapsed');
        }
        var $visibleCount = $(this.refs.results + ' h5:visible').length;
        var $visibleNotCollapsedCount = $(this.refs.results + ' h5:visible:not(.collapsed)').length;
        var $toggle = $(this.refs.results + ' .collapse-toggle');
        if ($visibleNotCollapsedCount == 0) {
            $toggle.html($toggle.data('lang-expand'));
        } else if ($visibleCount == $visibleNotCollapsedCount) {
            $toggle.html($toggle.data('lang-collapse'));
        }

    },
    toggleAllResultSets: function () {
        var $visibleCount = $(this.refs.results + ' h5:visible:not(.collapsed)').length;
        var $toggle = $(this.refs.results + ' .collapse-toggle');
        if ($visibleCount == 0) {
            $(this.refs.results + ' ul').slideDown();
            $(this.refs.results + ' h5').removeClass('collapsed');
            $toggle.html($toggle.data('lang-collapse'));
        } else {
            $(this.refs.results + ' ul').slideUp();
            $(this.refs.results + ' h5').addClass('collapsed');
            $toggle.html($toggle.data('lang-expand'));
        }
    }
};

$(document).ready(blendIntelliSearch.init);
