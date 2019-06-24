<ul class="list-group checked-list-box col-sm-12 col-xs-12">
    <li class="list-group-item" data-style="button" style="cursor: pointer;"><span class="state-icon glyphicon glyphicon-unchecked"></span>&nbsp;Notify me when spot open<input type="checkbox" class="hidden"></li>
</ul>
<script>
$(document).ready(function() {
            $('.list-group.checked-list-box .list-group-item').each(function () {

                // Settings
                var $widget = $(this),
                        $checkbox = $('<input type="checkbox" {{ ($markers->openSpotNotification > 0? 'checked' : '') }} class="hidden" />'),
                        color = ($widget.data('color') ? $widget.data('color') : "primary"),
                        style = ($widget.data('style') == "button" ? "btn-" : "list-group-item-"),
                        settings = {
                            on: {
                                icon: 'glyphicon glyphicon-check'
                            },
                            off: {
                                icon: 'glyphicon glyphicon-unchecked'
                            }
                        };

                $widget.css('cursor', 'pointer')
                $widget.append($checkbox);

                // Event Handlers
                $widget.on('click', function () {
                    $checkbox.prop('checked', !$checkbox.is(':checked'));
                    $checkbox.triggerHandler('change');
                    updateDisplay();
                    var notification;
                    if ($checkbox.is(':checked')) {
                        notification = 'true';
                    } else {
                        notification = 'false';
                    }
                    var data = {poiID: {{ $markers->id }}, hostID: {{ $markers->user_id }}, notification:notification};
                    $.ajax({
                    	url: "/notifyMeWhenSpotOpen",
                    	type: "post",
                    	data: data,
                    	success: function() {
                    		

                    	}
                    })
                });
                $checkbox.on('change', function () {
                    updateDisplay();
                });


                // Actions
                function updateDisplay() {
                    var isChecked = $checkbox.is(':checked');

                    // Set the button's state
                    $widget.data('state', (isChecked) ? "on" : "off");

                    // Set the button's icon
                    $widget.find('.state-icon')
                            .removeClass()
                            .addClass('state-icon ' + settings[$widget.data('state')].icon);

                    // Update the button's color
                    if (isChecked) {
                        $widget.addClass(style + color + ' active');
                    } else {
                        $widget.removeClass(style + color + ' active');
                    }
                }

                // Initialization
                function init() {

                    if ($widget.data('checked') == true) {
                        $checkbox.prop('checked', !$checkbox.is(':checked'));
                    }

                    updateDisplay();

                    // Inject the icon if applicable
                    if ($widget.find('.state-icon').length == 0) {
                        $widget.prepend('<span class="state-icon ' + settings[$widget.data('state')].icon + '"></span> ');
                    }
                }
                init();
            });
         });
</script>