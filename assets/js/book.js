$(function() {  

    var $pbuttons = $('[data-page-index], .topmenu a'),
        $pages  = $('[data-page]'),
        hash    = new URL(window.location).hash.substring(1);
        curpage = 0;

    $pbuttons.on('click', function(e){
        e.preventDefault();
        var $this = $(this), $page, index;

        if(!$this.attr('data-page-index')) {
            $this.data('page-index', $($this.attr('href')).data('page'));
        }
      
        $('html').removeClass('menuopen');

        if(!$this.hasClass('active')) {
            $('.box_book_pages').addClass('active');
            index = goToPage( $this.data('page-index'), $pages.length, ($this.data('page-index') < curpage));
            
            $pages.removeClass('active done current');
            $pages.eq($this.data('page-index')).addClass('current');
            if(index > 0){
                $pages.eq(index).addClass('active');
                $pages.eq(index).prevAll().addClass('active done');
            }            
            curpage = index;

            if(curpage === 0) {
                $('.box_book_pages').removeClass('active');    
            }
        } 
    });

    if(hash && $('[href="#'+hash+'"]').length) {
        $('[href="#'+hash+'"]').eq(0).trigger('click');  
    }

    function goToPage( indx, len, down = false) {
        if(down) {            
            if(fns.isEven(indx)){
                return Math.max(indx, 0);
            } else {
                return indx;    
            }   
        } else {
            if(fns.isEven(indx)){
                return indx;
            } else {
                return Math.min(indx + 1, len);
            }   
        }
    }


});