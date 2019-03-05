$(function() {

    var $win = $(window),
        $box = $('.box-crafted'),
        $parts = null,
        //$boxForm = $('.box-form-section'),
        //$boxFrames = $boxForm.find('.frame-list li'),
        boxY = 0,
        isFirefox = navigator.userAgent.match(/Firefox/) !== null;


    if ($('html').hasClass('no-touch')) {
        $parts = setPartsData();

        var animationHandler = function() {
            boxPartsHandler();

            // quick fix to disable turn animation in Firefox
            //if ( isFirefox == false) {
                //boxTurnHandler();
            //}
        };

        $(document).scroll(animationHandler);
        $win.resize(animationHandler);
    }


    function fadeText($el) {
        $el.toggleClass('fade-in', boxY > $el.data('fade'));
    }


    function setPartsData() {
        return $box.find('li').each(function() {
            var $part = $(this),
                anim = $part.attr('data-anim').split('|');

            $part
                .data('name',     $part.find('.part-name'))
                .data('desc',     $part.find('.part-desc'))
                .data('isBody', $part.hasClass('box-body'))
                .data('origin',   parseInt(anim[0], 10))
                .data('start',    parseInt(anim[1], 10))
                .data('fade',     parseInt(anim[2], 10));
        });
    }

    function movePart($el) {
        var origin = $el.data('origin'),
            start = $el.data('start'),
            y = (boxY > start) ? origin + (boxY - start) : origin;

        // special case for the sensor to ease with the battery
        if ($el.data('isBody')) {

           // console.log(y);

            //y -= (1 - (1770 - boxY) / 225) * 140;
        }

        $el.css('top', Math.min(0, y));
    }

    // boxPartsHandler()
    //
    // Calculate the box y value and move each part based on the scroll
    // position of the browser window.
    function boxPartsHandler() {
        boxY = -($box.offset().top - ($win.scrollTop() + $win.height()));

        //console.log("boxY "+boxY);

        //$part.

        $parts.each(function() {
            var $part = $(this);

            movePart($part);
            fadeText($part);
        });
    }

    // boxTurnHandler()
    //
    //
   //function boxTurnHandler() {
    //    var scroll = ($win.scrollTop() + $win.height()) - ($boxForm.offset().top + $boxForm.outerHeight(true) / 2),
    //        ratio = scroll / $win.height() * 1.75;

     //   if (ratio >= 0 && ratio < 1) {
     //       var nextFrame = Math.floor(ratio * $boxFrames.length);
    //        $boxFrames
     //           .removeClass('active')
     //           .eq(nextFrame).addClass('active');
     //   }
    //}

});
