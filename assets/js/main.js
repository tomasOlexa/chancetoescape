/* http://benalman.com/projects/jquery-throttle-debounce-plugin/ */
(function(b,c){var $=b.jQuery||b.Cowboy||(b.Cowboy={}),a;$.throttle=a=function(e,f,j,i){var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g};$.debounce=function(d,e,f){return f===c?a(d,e,false):a(d,f,e!==false)}})(this);

var fns = {
    //ABOVE
    goAbove: function($elm, offset) {    
        var pos = $elm.parent()[0].getBoundingClientRect(),
            hei = $elm.outerHeight(),
            offset = offset || 0;
            
        return ( (pos.bottom + hei + offset) > $(window).height() && (pos.top - hei ) >  offset);
    },
    isInt: function(num,start,end){
        if(Math.floor(num) == num && fns.isNumeric(num)) {                          
            return true;
        }
        return false;
    },
    isNumeric: function(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    },
    isEven: function(n) {
        return n % 2 == 0;
    }
};


var st, $html;

$(function() {  

    var $window = $(window),   
        $body   = $('body'),        
        lastScrollTop = 0,  
        $header = $('.header_inner'),
        header_height = $('.header_inner').height(),
        is_scrolled   = false,
        is_scrolling  = false,
        ww            = $window.width(),
        wh            = $window.height(),
        animdelay_time  = 100,
        animdelay_count = 0,
        animdelay;  
    
    st = $window.scrollTop(); 
    $html = $('html');       
    
    //OBSERVER    
    var observer = new window.IntersectionObserver(function(entries, self) {   
        entries.forEach(function (entry) { 
                
            if (entry.isIntersecting) {   

                if($(entry.target).hasClass('isvideo')) { 
                    if((entry.intersectionRatio >= .5)){
                        entry.target.play();    
                    } else {
                        entry.target.pause();    
                    }
                } else {
                    if((entry.intersectionRatio == 1 && $(entry.target).hasClass('observe_full')) || !$(entry.target).hasClass('observe_full')) {
                        $(entry.target).addClass('intersecting');    
                        self.unobserve(entry.target);  
                        
                        if(entry.intersectionRatio == 1 && $(entry.target).hasClass('observe_full')){
                            $('.observe_sub', $(entry.target)).each(function(){
                                observer.observe($(this)[0]);    
                            });                        
                        }
    
                        if($(entry.target).hasClass('anim_delay')) {
                            clearTimeout(animdelay);   
                            animdelay_count++;
                            $(entry.target).css('animation-delay', (animdelay_count*animdelay_time) + ($(entry.target).data('animdelay-offset') || 0) + 200 + 'ms'); 
                            $(entry.target).css('--animation-delay', (animdelay_count*animdelay_time) + ($(entry.target).data('animdelay-offset') || 0) + 200);              
                            animdelay = setTimeout(function(){
                                animdelay_count = 0;    
                            },55);
                        }
    
                        if($(entry.target).hasClass('set_delay')) {
                            $(entry.target).css('animation-delay', ($(entry.target).data('animdelay-offset') || 0) + 200 + 'ms');    
                        }
                    }
                }
            }
        }); 
    }, {"threshold": [0,.5,1]});   
    
    $('.observe').each(function(){
        observer.observe($(this)[0]);    
    });

    //WIN SCROLL
    $window.on('resize', function(){
        wh = $window.height(); 
        ww = $window.width();
        header_height = $header.height();
    }).trigger('resize'); 
    
    //WIN SCROLL
    $window.on('scroll', function(){
        st = $window.scrollTop();    
        if(st < 0) st = 0;      
        scrolled();
        
        if (st > lastScrollTop || st == 0){
            $body.removeClass('scrollup');     
        } else {
            if((st - lastScrollTop) < -5) {
                $body.addClass('scrollup');    
            }                    
        }                 
        lastScrollTop = st;       
    }).trigger('scroll');  

    
    //TOGGLE MENU
    $('.toggle-menu').on('click', function(e){
        e.preventDefault();

        if($html.hasClass('menuopen')) {
            $html.removeClass('menuopen').addClass('closemenu');
        } else {
            $html.addClass('menuopen').removeClass('closemenu');    
        }   
        
        $('.toggle-menu-element').one('transitionend', function() {
            $(this).off('transitionend'); 
            $html.removeClass('closemenu');  
        });
    });  
   
    //OPEN POPUP
    $('[data-popup-open]').on('click', function(e){
        e.preventDefault();
        $html.addClass('popupopen');
        $($(this).data('popup-open')).addClass('active');
    });  

    //CLOSE POPUP
    $('[data-popup-close]').on('click', function(e){
        e.preventDefault();
        $html.removeClass('popupopen');
        $('.box_popup').removeClass('active');
    });  

    if($('[data-popup-onload="true"]').length) {
        $html.addClass('popupopen');
        $('[data-popup-onload="true"]').addClass('active');
    }

    //TOGGLE CLOSEST CLASS
    $('[data-toggle-closest]').on('click', function(e){
        e.preventDefault();
        console.log(
        $(this).data('toggle-closest'));
        $(this)
            .closest($(this).data('toggle-closest'))
            .toggleClass($(this).data('toggle-closest-class'));
    });    

    //SCROLLED
    function scrolled(){  
        if($window.scrollTop() > 0){
            if(!is_scrolled) {
                is_scrolled = true;
                $body.addClass('scrolled');
            }
        } else {
            if(is_scrolled) {
                is_scrolled = false;  
                $body.removeClass('scrolled');              
            }                 
        }   
    }
   
    //SLIDER
    $('.slider-custom').each(function(){
        var $this = $(this);     
       
        if($this.hasClass('slider-img-preload')) {
            preload($('img', $this).map(function(){return $(this).attr('src')}), 0, function(){
                createSlider($this);
            });    
        } else {
            createSlider($this);
        }        
    });      

    //CLICKERs   
    $('.clicker').clicker();     

    //ACCORDION
    var accords = document.querySelectorAll('.accord');

    accords.forEach(par => {

        var accorditems = par.querySelectorAll('.accorditem');

        accorditems.forEach(child => {

            var head = child.querySelector('.accordhead');

            head.addEventListener('click', function(e){
                e.preventDefault();
        
                if(child.classList.contains('expanded')) {
                    child.classList.remove('expanded');
                } else {
                    accorditems.forEach(item => {
                        item.classList.remove('expanded');
                    });                   
                    child.classList.add('expanded');
                }

            });
        });    
    });

    //SWITCH
    var switchs = document.querySelectorAll('.switch');
    switchs.forEach(sw => {
        var anch = sw.querySelectorAll(':scope > a, :scope > button');
        

        anch.forEach(a => {
            a.addEventListener('click', function(e){

                var slides = document.querySelectorAll(a.parentNode.dataset.switch + ' .switch-slide');
        
                e.preventDefault();

                anch.forEach(r => {
                    r.classList.remove('active');
                });        

                slides.forEach(r => {
                    r.classList.remove('active');
                });  
                
                a.classList.add('active');

                var indx = [].indexOf.call(anch, a);

                slides[indx].classList.add('active');

            })
        });       

    });

    //PAGE ANCHORS
    $('[data-scrollto]').on('click', function(e) {    
        e.preventDefault();
        $body.removeClass('menuopen');
        scroll_to($(this), 700, false);                             
    });  
    
    //INPUT DATE
    $('.input_date:not([data-dateend])').each(function(){
        var $this = $(this);   

        if($this.data('elementend')) {
            new Litepicker({
                element: $this[0],
                singleMode: false,
                allowRepick: true,
                minDate: new Date().getTime(), 
                format: "DD.MM. YYYY",
                lang: 'sk-SK',
                elementEnd: $($this.data('elementend'))[0]
            });     
        } else {
            new Litepicker({
                element: $this[0],
                singleMode: true,
                minDate: new Date().getTime(), 
                format: "DD.MM. YYYY",
                lang: 'sk-SK'
            });      
        }     
    });   

    //INPUT FILE
    $('.input_file').on('change', function(){
        var $text   = $(this).closest('[data-value]'),
            files   =  $(this)[0].files,
            val     = "";
       
        if(files.length) {

            for (var i = 0; i < files.length; i++) {
                if(i) val += ', '; 
                val += files[i].name;                
            }    
            
            $text.attr('data-value', val);

        } else {
            $text.attr('data-value', $(this).attr('placeholder'));
        }     
        
    });

    //NUMBER INPUT
    $('[data-input-number]').each(function(){
        var $par   = $(this).parent(),
            $input = $(this),
            suffix, min, max;
        
        $('.up', $par).on('click', function(){
            suffix = $input.data('input-suffix') || '';
            min    = $input.attr('min') || $input.data('input-number-min');
            max    = $input.attr('max') || $input.data('input-number-max');

            var val = $input.val().replace(suffix, '');
            if(!fns.isInt(val)) val = min; 
            val = parseInt(val);
            if(val >= max) return false;                       
            $input.val((val + 1) + suffix);    
            
            $input.trigger('recalculate');
        });
        
        $('.down', $par).on('click', function(){
            suffix = $input.data('input-suffix') || '';
            min    = $input.attr('min') || $input.data('input-number-min');
            max    = $input.attr('max') || $input.data('input-number-max');

            var val = $input.val().replace(suffix, '');
            if(!fns.isInt(val)) val = min;
            
            val = parseInt(val);
            
            if(val <= min) {
                $input.val(min + suffix);    
            } else {
                $input.val((val - 1) + suffix);     
            }    
            
            $input.trigger('recalculate');
        });
        
        $input
            .on('change blur', function(){
                suffix = $input.data('input-suffix') || '';
                min    = $input.attr('min') || $input.data('input-number-min');
                max    = $input.attr('max') || $input.data('input-number-max');

                var val = $(this).val().replace(suffix, '');
                if(!fns.isInt(val)) val = min;
                val = parseInt(val); 
                if(val <= min) {
                    $(this).val(min + suffix);
                    return false;
                } 
                if(val >= max) $(this).val(max + suffix);  

                $input.trigger('recalculate');
            });                         
    });

});

function scroll_to($this, spd, hist){
    if($this.length) {
        noanim = true;
        var datascrollto = $this.data('scrollto') || '', 
            href = (datascrollto.length) ? datascrollto : $this.attr('href'),    
            $elm = $('html,body'), 
            func = 'offset', 
            of_set = 0, 
            hh = $('.header_inner').height(),                 
            id = $(href).attr('id'),
            scrollpx;

        if(href == '#home') href = 'body';

        scrollpx = $(href)[func]().top + of_set;

        spd = Math.abs(st - $(href)[func]().top)/2.5;
        spd = Math.max(spd, 550);
        spd = parseInt(spd);

        scrollpx -= hh;

        $html.addClass('disable-scroll-behave');         
                         
        $elm.stop().animate({
            scrollTop: scrollpx
        }, spd, function () {               
            noanim = false;
            $html.removeClass('disable-scroll-behave');
        });   
    } 
}

//PRELOAD
function preload(imageArray, index, callback) {
    index = index || 0;    
    if (imageArray && imageArray.length > index) {
        var img = new Image ();
        img.onload = function() {
            preload(imageArray, index + 1, callback);
        }
        img.src = imageArray[index];
    } else {   
        if (typeof callback == 'function') { 
            callback(); 
        }
    }
}

function isTouchDevice() {
    return (('ontouchstart' in window) ||
        (navigator.maxTouchPoints > 0) ||
        (navigator.msMaxTouchPoints > 0));
}

//CREATE SLIDER
function createSlider($this) {
   
    if($this.hasClass('slider-ready')) {         
        return false;
    }

    var obj     = {},
        $par    = $this.parent();
        options = {                
            loop: true,
            speed: 1000,
            slidesPerView: 'auto',
            spaceBetween: 0             
        },
        optionsFade = {
            effect: 'fade'
        },
        optionsCenter = {
            centeredSlides: true,
        },
        settings_obj = $this.data('swiper-settings');
    
    $.extend( true, obj, options );

    if(typeof settings_obj === 'object' && settings_obj !== null) {

        $.extend( true, obj, settings_obj );
    
        if(settings_obj.fade) {
            $.extend( true, obj, optionsFade );
        }  
        
        if(settings_obj.center) {
            $.extend( true, obj, optionsCenter );
        }
    }

    if(obj.pagination) {
        obj.pagination.clickable = true;
    }

    if(obj.closestPagination) {
        var cpag = $par.find('.pagination');
        obj.pagination.el = cpag[0];
    }

    if(obj.closestScrollbar){
        obj.scrollbar = {};
        obj.scrollbar.el = $par.find('.swiperscrollbar');
        obj.scrollbar.hide = false;
        obj.scrollbar.draggable = true;
    }

    if(obj.closestNavigation) {
        obj.navigation = {"nextEl": $('.swiper-next', $this.closest(obj.closest))[0], "prevEl": $('.swiper-prev', $this.closest(obj.closest))[0]};
    }                

    //INIT SLIDER
    var slider = new Swiper($this[0], obj);
    $this
        .addClass('slider-ready')
        .data('swiper', slider);

    if(obj.mirror) {

        $.each(obj.mirror, function(i,v){
            var $mirror = $(v);

            var data = $mirror.data('swiper-settings');

            if(data.autoplay) {
                data.autoplay  = false;
                $mirror.data('swiper-settings-autoplaymirror', true);
                $mirror.data('swiper-settings', data);
            }   

            createSlider($mirror, true);
        });        
       
        $this.data('swiper').on('slideChangeTransitionStart', function(){
            
            var indx = $this.data('swiper').realIndex,
                func = (obj.loop) ? 'slideToLoop' : 'slideTo';
              
            if(!$this.data('swiper-pauseMirrorEvent')) {  
                $.each(obj.mirror, function(i,v){
                    var $mirror = $(v);
                    $mirror.data('swiper-pauseMirrorEvent', true);  
                    $mirror.data('swiper')[func](indx, $this.data('swiper').passedParams.speed, false);                   
                    $mirror.data('swiper-pauseMirrorEvent', false);      
                });
            }              
        });   
        
    }

    if(obj.loop){
        slider.loopDestroy();
        slider.loopCreate();
    }

    if(obj.initialSlide === 0){
        slider.slideToLoop(0, 0);      
    }

    if(obj.pagination){
        $(obj.pagination.el).addClass('ready');   
    }

    if(obj.thumbs){       
        $(obj.thumbs).on('click', function(e) {    
            e.preventDefault();
            var func = (obj.loop) ? 'slideToLoop' : 'slideTo';     
            slider[func]($(this).data('slideto'));                   
        });  
    }
    
}  

function leadingeZero(n){
    return n > 9 ? "" + n: "0" + n;
}

function randomIntFromInterval(min, max) { // min and max included 
    return Math.floor(Math.random() * (max - min + 1) + min)
}

/*CLICKER PLUGIN*/
(function($) {

    $.fn.clicker = function(method) {   
             
        this.each(function() {       
            create_clicker($(this));
        });

        function create_clicker($elm) {

            $elm.on('click.clicker', function(e){             
                e.preventDefault();

                var cd  = 'cdone',
                    cm  = this.dataset.class || 'cactive',
                    par = this.parentNode,
                    rcp = function(event){
                        if(!par.contains(event.target)){                
                            par.classList.remove(cm);
                            par.classList.remove(cd);
                            document.removeEventListener('mousedown', rcp);               
                        }                         
                    };  
            
                if(par.classList.contains(cm)) {
                    par.classList.remove(cm);
                    par.classList.remove(cd);
                    document.removeEventListener('mousedown', rcp);
                } else {
                    par.classList.add(cm);
                    par.offsetHeight;
                    par.classList.add(cd);
                    document.addEventListener('mousedown', rcp);

                    if($elm.data('focus')) {                
                        if($elm.data('focus-trans')) {
                            $html.addClass('disable-scroll-behave');
                            $( $elm.data('focus-trans') ).off('transitionend');
                            $( $elm.data('focus-trans') ).one('transitionend', function(){
                                $( $elm.data('focus') ).focus();     
                                $html.removeClass('disable-scroll-behave');  
                            });    
                        } else {
                            $html.addClass('disable-scroll-behave');
                            $( $elm.data('focus') ).focus();    
                            $html.removeClass('disable-scroll-behave');  
                        }   
                    }
                }  
            });  
        }
    }

}(jQuery));

function create_range() {
    var arr = [];
    for (let i=0; i<=1.0; i+= 0.01) {
        arr.push(i);
    }
    return arr;
} 

function youtube_parser(url){
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
    var match = url.match(regExp);
    return (match&&match[7].length==11)? match[7] : false;
}
