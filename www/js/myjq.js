$(document).ready(function() {

    $( window ).on("load resize scroll",function(){

        var nav = $('.prod-box-body');
        if (nav.length) {

            var eTop = nav.offset(); //get the offset top of the element
            var eTop2 = $(".prod-box-area1").offset(); //get the offset top of the element

            var wd = $(window).height();
            var cover_height = $(".prod-box-area").outerHeight();
            var inner_height = $(".prod-box-area1").outerHeight();
            var botdist = 200+cover_height;

            var dpos = $(window).scrollTop();

            var point_to_start = eTop2.top + inner_height;

            var cp = eTop.top - wd;
            var curpos =  dpos - cp;
            var popravka = 0-inner_height-147
           
            var fixpos =  popravka + curpos - botdist;

            


            if (curpos > botdist) {

                var moveagain = point_to_start-dpos;
                var block_pos;

                //if (moveagain < botdist && block_pos != 0) {
                //    fixpos = block_pos;
                //} else {
                //    block_pos = fixpos;
                //}

                if (fixpos > 0) fixpos = 0;


                $(".prod-box-area2").css('top', fixpos);

                //$(".prod-box-area").addClass("prod-box-area-fixed");
                //$(".prod-box-area").addClass("prod-box-area-fixed");

            } else {
                $(".prod-box-area2").css('top', popravka);
                //$(".prod-box-area").removeClass("prod-box-area-fixed");     
            }


            console.log("dpos:"+dpos+" wd:"+wd+" eTop2.top:"+point_to_start+" curpos:"+curpos);
       } else {
               console.log(nav.length);         
       }


        //log(eTop - $(window).scrollTop()); //position of the ele w.r.t window
        //var p = $(".prod-box-body");
        //var offset = p.position();
        //console.log(eTop.top - $(window).scrollTop());
        //console.log(dpos +" " + cp+" "+ wd);

    });

});
