'use strict';

jQuery(function($) {

	var $window = $(window),
		$body = $('body'),
		screenWidth = $window.width(),
		screenHeight = $window.height(),
		scrollBarWidth = 0;

	$window.on('resize orientationchange', function() {
		screenWidth = $window.width();
		screenHeight = $window.height();
	});

	$window.on('load', function() {
		$window.resize();
	});

	window.hency = {
		init : function() {
			this.resizedEvent(400); // Trigger Event after Window is Resized
			this.ieWarning(); // IE<9 Warning
			this.disableEmptyLinks(); // Disable Empty Links
			this.toolTips(); // ToolTips Init
			this.placeHolders(); // PlaceHolders Init
			this.selects(); // Selects Init
			this.checkBoxes(); // Styled CheckBoxes, RadioButtons
			this.scrollToAnchors(); // Smooth Scroll to Anchors
			this.scrollBarWidthDetection(); // ScrollBar Width Detection
			this.videoPlayerRatio(); // Video Player Ratio

			this.parallaxInit(); // Parallax
			this.leftSideBar(); // Left SideBar
			this.rightSideBar(); // Right SideBar
			this.floatingMenu(); // Floating Menu for Mobiles
			this.headerSearchForm(); // Search Form in Header
			this.lightBox(); // LightBox (swipeBox)
			this.owlSlidersInit(); // Owl Carousels
			this.linkActionDelay(); // Delays Link Actions for Mobile Devices
			this.leftMenu(); // Scrollable Left Menu
			this.eventsCalendar(); // Events Calendar
			this.datePickerInit(); // Datepickers
			this.popups(); // Datepickers
			this.skillsCounter(); // ProgressBars Animation

			this.additionalInit(); // Additional JS

			//this.screenResInfo(); // Screen Resolution Info for Developers
		},

		resizedEvent : function(delay) {
			var resizeTimerId;

			$window.on('resize orientationchange', function() {
				clearTimeout(resizeTimerId);

				resizeTimerId = setTimeout( function() {
					$window.trigger('resized');
				}, delay);
			});
		},

		ieWarning : function() {
			if ($('html').hasClass('oldie')) {
				$body.empty().html('Please, Update your Browser to at least IE9');
			}
		},

		disableEmptyLinks : function() {
			$('[href="#"], .btn.disabled').on('click', function(event) {
				event.preventDefault();
			});
		},

		toolTips : function() {
			$('[data-toggle="tooltip"]').tooltip();
		},

		placeHolders : function() {
			if ($('[placeholder]').length) {
				$.Placeholder.init();
			}
		},

		selects : function() {
			$(".select2").select2({
				minimumResultsForSearch: Infinity
			});
		},

		checkBoxes : function() {
			$.fn.customInput = function() {
				$(this).each(function () {
					var container = $(this),
						input = container.find('input'),
						label = container.find('label');

					input.on('update', function() {
						input.is(':checked') ? label.addClass('checked') : label.removeClass('checked');
					})
						.trigger('update')
						.on('click', function() {
							$('input[name=' + input.attr('name') + ']').trigger('update');
						});
				});
			};

			$('.checkbox, .radio').customInput();
		},

		scrollToAnchors : function() {
			$('.anchor[href^="#"]').on('click', function(e) {
				e.preventDefault();
				var speed = 1,
					boost = 1,
					offset = 5,
					target = $(this).attr('href'),
					currPos = parseInt($window.scrollTop(), 10),
					targetPos = target!="#" && $(target).length==1 ? parseInt($(target).offset().top, 10) - offset : currPos,
					distance = targetPos - currPos;

				boost = Math.abs(distance * boost / 1000);

				$("html, body").animate({scrollTop: targetPos}, parseInt(Math.abs(distance / (speed + boost)), 10));
			});
		},

		scrollBarWidthDetection : function() {
			$body.append('<div class="scrollbar-detect"><span></span></div>');

			var scrollBarDetect = $('.scrollbar-detect');

			scrollBarWidth = scrollBarDetect.width() - scrollBarDetect.find('span').width();

			scrollBarDetect.remove();
		},

		videoPlayerRatio : function() {
			function setRatio() {
				$('.video-player').each(function() {
					var self = $(this),
						ratio = self.attr('width') && self.attr('height') ? self.attr('width') / self.attr('height') : 16/9,
						videoWidth = self.width();

					self.css({height: videoWidth / ratio});

					self.trigger('videoPlayerRatioSet');
				});
			}

			setRatio();

			$window.on('resized', function() {
				setRatio();
			});
		},

		parallaxInit : function() {
			$.fn.parallax = function() {
				var parallax = $(this),
					xPos = parallax.data('parallax-position') ? parallax.data('parallax-position') : 'center',
					speed = parallax.data('parallax-speed') || parallax.data('parallax-speed') == 0 ? parallax.data('parallax-speed') : .1;

				function runParallax() {
					var scrollTop = $window.scrollTop(),
						offsetTop = parallax.offset().top,
						parallaxHeight = parallax.outerHeight();

					if (scrollTop + screenHeight > offsetTop && offsetTop + parallaxHeight > scrollTop) {
						var yPos = parseInt((offsetTop - scrollTop) * speed, 10);

						parallax.css({
							backgroundPosition: xPos + ' ' + yPos + 'px'
						});
					}
				}

				if (screenWidth > 1000 && !parallax.hasClass('parallax-disabled')) {
					parallax.css({
						backgroundAttachment: 'fixed'
					});
					runParallax();
				}
				$window.on('scroll', function () {
					if (screenWidth > 1000 && !parallax.hasClass('parallax-disabled')) {
						parallax.css({
							backgroundAttachment: 'fixed'
						});
						runParallax();
					}
				});
				$window.on('resized', function () {
					if (screenWidth > 1000 && !parallax.hasClass('parallax-disabled')) {
						parallax.css({
							backgroundAttachment: 'fixed'
						});
						runParallax();
					} else {
						parallax.css({
							backgroundPosition: '50% 0',
							backgroundAttachment: 'scroll'
						});
					}
				});
			};

			$('.parallax').each(function () {
				$(this).parallax();
			});
		},

		leftSideBar : function() {
			var sidebar = $('.sidebar-left'),
				toggleButton = sidebar.find('.sidebar-left-toggle');

			toggleButton.on('click', function(e) {
				e.preventDefault();

				sidebar.toggleClass('active');
			});

			if (Modernizr.touchevents) {
				sidebar.swipe({
					swipeLeft: function() {
						sidebar.removeClass('active');
					},
					threshold: 80,
					excludedElements: ''
				});
			}
		},

		rightSideBar : function() {
			var sidebar = $('.sidebar'),
				toggleButton = sidebar.find('.sidebar-toggle');

			if($window.width() > 1359 - scrollBarWidth) {
				sidebar.stick_in_parent({spacer: false});
			}

			$window.on('resized', function() {
				if($window.width() > 1359 - scrollBarWidth) {
					sidebar.stick_in_parent({spacer: false});
				} else {
					sidebar.trigger('sticky_kit:detach');
				}
			});

			toggleButton.on('click', function(e) {
				e.preventDefault();

				sidebar.toggleClass('active');
			});

			if (Modernizr.touchevents) {
				sidebar.swipe({
					swipeRight: function() {
						sidebar.removeClass('active');
					},
					threshold: 80,
					excludedElements: ''
				});
			}
		},

		floatingMenu : function() {
			var menu = $('.floating-menu');

			if (Modernizr.touchevents) {
				menu.swipe({
					swipeLeft: function() {
						menu.removeClass('active');
					},
					swipeRight: function() {
						menu.addClass('active');
					},
					threshold: 20,
					excludedElements: ''
				});
			}
		},

		headerSearchForm : function() {
			var form = $('.form-search-header'),
				formButton = $('.form-search-open');

			formButton.on('click', function() {
				form.toggleClass('active');
			});

			$body.on('click', function(event) {
				var element = $(event.target);

				if(!element.hasClass('form-search-header') && !element.hasClass('form-search-open') && !element.closest('.form-search-header').length) {
					form.removeClass('active');
				}
			});

			$window.on('keydown', function(event) {
				if(event.keyCode === 27) {
					form.removeClass('active');
				}
			});
		},

		lightBox : function() {
			$('.swipebox, .swipebox-video').swipebox({
				removeBarsOnMobile: false,
				autoplayVideos: true
			});
		},

		owlSlidersInit : function() {
			// Banners Slider
			$(".banners-slider").owlCarousel({
				singleItem: true,
				navigation : true,
				navigationText : false,
				pagination : false
			});

			// Photo/Video Slider
			$(".photo-slider").owlCarousel({
				items : 3,
				itemsDesktop : [1359, 3],
				itemsDesktopSmall : [1229, 3],
				itemsTablet : [991, 2],
				itemsMobile : [767, 1],
				navigation: true,
				navigationText : false,
				pagination: false
			});

			// Subscribe Cards Slider
			$(".subscribe-cards-slider").owlCarousel({
				items : 3,
				itemsDesktop : [1359, 3],
				itemsDesktopSmall : [1229, 3],
				itemsTablet : [991, 2],
				itemsMobile : [767, 1],
				navigation: true,
				navigationText : false,
				pagination: false
			});
		},

		linkActionDelay : function() {
			if(Modernizr.touchevents) {
				var delayedLinks = $('.js-action-delay');

				if(!delayedLinks.length) return false;

				var delayTimerId;

				$body.on('click', function(event) {
					var element = $(event.target);

					if(!element.hasClass('js-action-delay') && !element.closest('.js-action-delay').length) {
						clearTimeout(delayTimerId);
						delayedLinks.removeClass('active');
					}
				});

				delayedLinks.on('click', function(event) {
					event.preventDefault();
					clearTimeout(delayTimerId);

					var self = $(this),
						path = self.attr('href');

					delayedLinks.removeClass('active');

					self.addClass('active');

					delayTimerId = setTimeout(function() {
						window.location.href = path;

					}, 4000);
				});
			}
		},

		leftMenu : function() {
			var menu = $('.side-menu'),
				sidebar = $('.sidebar-left'),
				rowTop = sidebar.find('.row-top'),
				rowMiddle = sidebar.find('.row-middle'),
				rowBottom = sidebar.find('.row-bottom'),
				scrollSettings = {
					cursorwidth: 6,
					cursorborderradius: 0,
					hidecursordelay: 4000
				};

			function setRowHeight() {
				rowMiddle.css({
					height: $window.height() - rowTop.outerHeight() - rowBottom.outerHeight()
				})
			}

			$window.on('load', function() {
				setRowHeight();

				menu.niceScroll(scrollSettings);
			});

			$window.on('resized', function() {
				setRowHeight();

				menu.getNiceScroll().remove();

				menu.niceScroll(scrollSettings);
			});
		},

		eventsCalendar : function() {
			$('#calendar').each(function() {
				var calendar = $(this).calendar({
					events_source: 'events.json.php',
					view: 'month',
					tmpl_path: 'tmpls/',
					tmpl_cache: false,
					first_day: 1,
					holidays: {},
					//modal: '#events-modal',
					day: '2016-07-16',
					onAfterEventsLoad: function(events) {
						if(!events) {
							return;
						}
						var list = $('#eventlist');
						list.html('');

						$.each(events, function(key, val) {
							$(document.createElement('li'))
								.html('<a href="' + val.url + '">' + val.title + '</a>')
								.appendTo(list);
						});
					},
					onAfterViewLoad: function(view) {
						$('.calendar-title').text(this.getTitle());

						$('.cal-month-day').each(function () {
							var $this = $(this);
							if($this.find('.events-list').length) {
								$this.addClass('cal-day-event');

								var events = $this.find('.event').length;
								if(events == 1) {
									$this.find('.events-list').text(events + ' Прогноз');
								} else {
									$this.find('.events-list').text(events + ' Прогноза');
								}
							}
						});
					},
					classes: {
						months: {
							general: 'label'
						}
					}
				});

				$('[data-calendar-nav]').on('click', function(e) {
					e.preventDefault();
					calendar.navigate($(this).data('calendar-nav'));
				});
				$('[data-calendar-view]').on('click', function(e) {
					e.preventDefault();
					calendar.view($(this).data('calendar-view'));
				});
			});
		},

		datePickerInit : function() {
			$('.datepicker').each(function() {
				var self = $(this);

				self.datepicker({
					firstDay: 0,
					dateFormat: 'dd/mm/yy',
					showOtherMonths: true
				});
			});
		},

		popups : function() {
			$('[data-popup="open"]').on('click', function(event) {
				event.preventDefault();

				var targetId = $(this).data('popup-target');

				$(targetId).addClass('active');
			});

			$('[data-popup="close"]').on('click', function(event) {
				event.preventDefault();

				var targetId = $(this).data('popup-target');

				$(targetId).removeClass('active');
			});

			$('.popup-close').on('click', function(event) {
				event.preventDefault();

				$(this).closest('.popup').removeClass('active');
			});

			$window.on('keydown', function(event) {
				if(event.keyCode === 27) {
					$('.popup').removeClass('active');
				}
			});

			if (Modernizr.touchevents) {
				$('.popup').swipe({
					swipeLeft: function() {
						$('.popup').removeClass('active');
					},
					threshold: 200
				});
			}

			$('.gallery-slider').find('.carousel-inner').swipe({
				swipeLeft: function() {
					$(this).parent().carousel('next');
				},
				swipeRight: function() {
					$(this).parent().carousel('prev');
				},
				threshold: 60
			});
		},

		skillsCounter : function() {
			$('.skill').each(function() {
				var self = $(this),
					percent = self.data('percentage'),
					percentage = self.find('.skill-percentage'),
					progress = self.find('.progress-bar'),
					progressAnimated = false;

				//percentage.text('0%');
				progress.css({width: 0 + '%'});

				$window.on('load scroll', function() {
					if (progressAnimated) return;

					if(self.offset().top < $window.scrollTop() + screenHeight) {
						progressAnimated = true;

						for(var i = 1; i < 21; i++) {
							var timeOuted = function(i) {
								return setTimeout(function() {
									//percentage.text(parseInt(percent*i/20) + '%');
									progress.css({width: percent*i/20 + '%'});
								}, i*200);
							};

							timeOuted(i);
						}
					}
				});
			});
		},

		screenResInfo : function() {
			var container = $('<div class="screen-resolution" style="position: fixed; top: 20px; right: 0; z-index: 9999; padding: 4px; background-color: #eee;"></div>'),
				breakPoint = '@xxs';

			container.appendTo($body);

			$window.on('resize orientationchange', function() {
				breakPoint = '@xxs';

				if(screenWidth + scrollBarWidth > 479) breakPoint = '@xs';
				if(screenWidth + scrollBarWidth > 767) breakPoint = '@sm';
				if(screenWidth + scrollBarWidth > 991) breakPoint = '@md';
				if(screenWidth + scrollBarWidth > 1229) breakPoint = '@xmd';
				if(screenWidth + scrollBarWidth > 1359) breakPoint = '@lg';
				if(screenWidth + scrollBarWidth > 1599) breakPoint = '@xlg';
				if(screenWidth + scrollBarWidth > 1799) breakPoint = 'full';

				container.text((screenWidth + scrollBarWidth) + ' x ' + screenHeight + ' ' + breakPoint);

				if(screenWidth + scrollBarWidth < 768) {
					container.addClass('hidden');
				} else {
					container.removeClass('hidden');
				}
			});
		},

		additionalInit : function() {
			// Write here some JS




		}
	};

	hency.init();
});