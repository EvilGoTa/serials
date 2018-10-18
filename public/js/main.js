$('.menu-toggle').on('click', function() {
    $('#side-menu').toggleClass('open');
    return false;
})

markTest = function(params) {
    this.serial = params.serial;
    this.$wrapper = params.wrapper;
    this.currentQuestion = 1;
};

var currentQuestion = 1;

var questions = {
    
    1: {
        text: window.serial_attributes['humor'],
        property: 'humor',
        mark: 0,
        state: 0,
    },
    2: {
        text: window.serial_attributes['drama'],
        property: 'drama',
        mark: 0,
        state: 0,
    },
    3: {
        text: window.serial_attributes['melodrama'],
        property: 'melodrama',
        mark: 0,
        state: 0,
    },
    4: {
        text: window.serial_attributes['trash'],
        property: 'trash',
        mark: 0,
        state: 0,
    },
    5: {
        text: window.serial_attributes['action'],
        property: 'action',
        mark: 0,
        state: 0,
    },
    6: {
        text: window.serial_attributes['erotic'],
        property: 'erotic',
        mark: 0,
        state: 0,
    },
    7: {
        text: window.serial_attributes['beauty'],
        property: 'beauty',
        mark: 0,
        state: 0,
    },
    8: {
        text: window.serial_attributes['concept'],
        property: 'concept',
        mark: 0,
        state: 0,
    },
    9: {
        text: window.serial_attributes['story'],
        property: 'story',
        mark: 0,
        state: 0,
    },
    10: {
        text: window.serial_attributes['fantastic'],
        property: 'fantastic',
        mark: 0,
        state: 0,
    },
    11: {
        text: window.serial_attributes['wow'],
        property: 'wow',
        mark: 0,
        state: 0,
    },
    12: {
        text: window.serial_attributes['criminal'],
        property: 'criminal',
        mark: 0,
        state: 0,
    },
    13: {
        text: window.serial_attributes['horror'],
        property: 'horror',
        mark: 5,
        state: 0,
    }
}

var rangeSlider = document.getElementById('uiSlider');

if (rangeSlider) {
    var slider = noUiSlider.create(rangeSlider, {
        start: 50,
        step: 1,
        connect: [true, false],
        padding: 5,
        tooltips: true,
        range: {
            'min': [  -5 ],
            'max': [ 105 ]
        },
        format: {
            to: function(val) {

                return Math.abs(parseFloat(val).toFixed())+'%';
            },
            from: function(val) {

                return parseFloat(val.replace('%', '')).toFixed(2);
    }
        }
    });

    var rangeSliderValueElement = document.getElementById('slider-val');

    rangeSlider.noUiSlider.on('update', function( values, handle ) {
        // rangeSliderValueElement.innerHTML = Math.floor(values[handle]) + '/15';
        $('#uiSlider').css({'opacity': 1});
    });


    function setQuestion() {
        $('.mark-slider').toggleClass('next');
        setTimeout(function() {
            $('.mark-slider').toggleClass('next');
            $('.mark-slider').toggleClass('next-2');
            var title = $('.mark-slider').attr('data-title');
            var text = questions[currentQuestion].text.replace('{serial}', title);
            $('.mark-slider').find('.title').text(text);
            if (window.serial_usermarks[currentQuestion] !== undefined) {
                rangeSlider.noUiSlider.set(window.serial_usermarks[currentQuestion]+5);
                $('#uiSlider').css({'opacity': 1});
            } else {
                rangeSlider.noUiSlider.set(55);
                $('#uiSlider').css({'opacity': .5});
            }
            $('#uiSlider').css({'padding': 0});
            $('#uiSlider').css({'marginBottom': 30});
            $(rangeSliderValueElement).find('.mark-progress-text').html('Вопрос ' + (currentQuestion)+' из '+Object.keys(questions).length);
            var percent = currentQuestion / (Object.keys(questions).length/100);
            console.log(percent.toFixed());
            $(rangeSliderValueElement).find('.mark-progress-bar').css({width: percent.toFixed() + '%'});

        }, 300);
        setTimeout(function() {
            $('.mark-slider').toggleClass('next-2');
        }, 350);
    }

    function acceptQuestion() {
        questions[currentQuestion].mark = parseInt(rangeSlider.noUiSlider.get());
        if ($('#uiSlider').css('opacity') == 1) {
                $.post('', {
                question: currentQuestion,
                mark: questions[currentQuestion].mark,
                '_token': $('input[name="mark_csrf"]').val(),
            }, function() {

            });    
        }
        
        skipQuestion();
    }

    function backQuestion() {
        currentQuestion--;
        if (!questions[currentQuestion]) {
            currentQuestion = 1;
            $('#markModalCenter').modal('hide');
        }
        setQuestion();
    }

    function skipQuestion() {
        currentQuestion++;
        if (!questions[currentQuestion]) {
            currentQuestion = 1;
            $('#markModalCenter').modal('hide');
        }
        setQuestion();
    }

    setQuestion();

    $('.marks-skip').click(skipQuestion);
    $('.marks-accept').click(acceptQuestion);
    $('.marks-back').click(backQuestion);

}

$('.slider-param').each(function() {
    var start = $(this).next().val();
    var slider = noUiSlider.create(this, {
        start: start,
        step: 1,
        connect: [true, false],
        padding: 10,
        range: {
            'min': [  -10 ],
            'max': [ 110 ]
        }
    });

    var block = $(this);
    var target = $(this).next();
    var enabled = $(this).prev().find('[type="hidden"]');
    var title = $(this).prev();
    this.noUiSlider.on('update', function( values, handle ) {
        // rangeSliderValueElement.innerHTML = Math.floor(values[handle]) + '/15';
        target.val(Math.floor(values[handle]));
        if (enabled.val() == 0) {
            block.css({opacity: .5})
            title.removeClass('active');
        } else {
            title.addClass('active');
        }
    });
    this.noUiSlider.on('slide', function( values, handle ) {
        enabled.val(1);
        block.css({opacity: 1});
        title.addClass('active');
    });
})   

$('.addToFav').click(function() {
    var obj = $(this);
    var serial = obj.attr('data-serial');
    var token = obj.attr('data-token');
    $.post('/favorite/'+serial, {'_token': token}, function() {
        obj.toggleClass('active');
    });

}) 

$('#trailerModal').on('hidden.bs.modal', function (e) {
    var src = $('#trailerModal iframe').attr('src');
    $('#trailerModal iframe').attr('src', '');
    $('#trailerModal iframe').attr('src', src);
})

$('.tooltipster').tooltipster({
    theme: 'tooltipster-borderless',
    side: ['right', 'left'],
});

$('#search_loadMode').click(function() {
    var query = $(this).attr('data-query');
    var pages = $(this).attr('data-pages');
    var page = $('.current-page:last').val() * 1 + 1;
    $(this).css('opacity', '.5');
    var that = $(this);
    $.get('/search', {query: query, page: page}, function(html) {
        $('#search-content').append(html);
        that.css('opacity', '1');
    });
    if (page == pages) {
        $(this).remove();
    }
    return false;
});

// плавная прокрутка к якорю
// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 300, function() {
          // Callback after animation
          // Must change focus!
          // var $target = $(target);
          // $target.focus();
          // if ($target.is(":focus")) { // Checking if the target was focused
          //   return false;
          // } else {
          //   $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
          //   $target.focus(); // Set focus again
          // };
        });
      }
    }
  });

$(function() {
    setTimeout(function() {
        $('.before-loaded').removeClass('before-loaded');
    }, 500);
});