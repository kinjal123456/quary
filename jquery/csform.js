(function($) {
	$.fn.csform = function(options) {
		options = $.extend($.fn.csform.defaults, options);
		//var opts = $.extend({}, $.fn.csform.defaults, options);
		//var elements= new Array();
		
		if($.browser.msie && $.browser.version < 7){
			$.support.selectOpacity = false;
		}else{
			$.support.selectOpacity = true;
		}
		
		return this.each(function(){
			if($.support.selectOpacity && $(this).css("opacity")>0) {
				var elem = $(this);
				
				if(elem.is("select")){
                    doSelect(elem);
				}
                else if(elem.is(":text, :password, input[type='email']")){
                    if(!elem.hasClass('hasCsform'))
						doInput(elem);
				}
                else if(elem.is("textarea")){
                    if(!elem.hasClass('hasCsform'))
						doTextarea(elem);
				}
                else if(elem.is(":radio")) {
                    doRadio(elem);
				}
                else if(elem.is(":checkbox")) {
                    doCheckbox(elem);
				}
                else if(elem.is(":file")) {
                    doFileType(elem);
				}
                /*else if(elem.is(":submit") || elem.is(":reset") || elem.is("button") || elem.is("input[type=button]")){
				    doButton(elem);
				}
                else if(elem.is("a")){
				    doAnchor(elem);
				}*/
			}
		});
		
		function doSelect(elem){ // Combobox
			var $ele = $(elem);
			var divTag = $('<div />'), spanTag=$('<span />');

            $ele.wrap(divTag);
            if($ele.attr("csformType") == "square"){
                $ele.parent('div').addClass("typeSquare");
            }
            $ele.wrap(divTag);
            $ele.parent('div').addClass(options.selectClass);
            $ele.wrap(divTag);
            $ele.parent('div').addClass(options.selectright);
			
			var selected = elem.find(":selected:first");
			if(selected.length == 0){
				selected = elem.find("option:first");
			}
			spanTag.text(selected.html());
			
			elem.before(spanTag);
			//redefine variables
			divTag = elem.parent("div");
			spanTag = elem.siblings("span");
			
			var text = ellipsis(divTag, selected.html(), $(divTag).width());
			spanTag.text(text);

			if($.browser.msie && $.browser.version <= 7){
				$(elem).css("padding-top","10px");
			}

			$(elem).bind("change keyup",function(event) {
				var text = ellipsis(divTag, elem.find(":selected").html(), $(divTag).width());
				spanTag.html(text);
			});

			/*$(elem).bind("mouseenter",function(event) {
				divTag.addClass(options.hoverClass);
			});
			$(elem).bind("mouseleave",function(event) {
				divTag.removeClass(options.hoverClass);
			});*/

			$(elem).bind("focus",function(event) {
                $(this).closest('.selector').parent('div').addClass(options.focusClass);
			});

			$(elem).bind("blur",function(event) {
                $(this).closest('.selector').parent('div').removeClass(options.focusClass);
			});
			
			if($(elem).attr("disabled")) {
                $(elem).closest('.selector').parent('div').addClass(options.disabledClass);
			}

			storeElement(elem);
		}
		
		function doInput(elem){
			var $el = $(elem);
            $el.addClass("hasCsform");
			var divTag = $('<div />');
			
			$el.wrap(divTag);

            if($el.hasClass("hasDatepicker")){
//                alert("a");
            }

            if($el.hasClass('calenderinput')){
                $el.parent('div').addClass('calenderinput');
            }
            if($el.attr("csformType") == "square"){
                $el.parent('div').addClass("typeSquare");
            }
			$el.wrap(divTag);
			$el.parent('div').addClass('inputleft');
			$el.wrap(divTag);
			$el.parent('div').addClass('inputright');
            $el.wrap(divTag);
            $el.parent('div').addClass('inputmid');
		
			if($el.attr("disabled")) {
                $el.closest('.inputleft').parent('div').addClass(options.disabledClass);
			}

			$(elem).bind("focus",function(event) {
				$(this).closest('.inputleft').parent('div').addClass(options.focusClass);
			});

			$(elem).bind("blur",function(event) {
				$(this).closest('.inputleft').parent('div').removeClass(options.focusClass);
			});

			/*$(elem).bind("mouseenter",function(event) {
				$el.closest('.inputleft').parent('div').addClass(options.hoverClass);
			});
			$(elem).bind("mouseleave",function(event) {
				$(elem).closest('.inputleft').parent('div').removeClass(options.hoverClass);
			});*/

			storeElement(elem);
		}
		
		function doTextarea(elem) {
			var $el = $(elem);
            $el.addClass("hasCsform");
			var divTag = $('<div />');

            $el.wrap(divTag);
            if($el.is(":disabled")) {
                $el.parent('div').addClass(options.disabledClass);
            }
            $el.wrap(divTag);
            $el.parent('div').addClass('textareaclass');
            var ta_top = $('<div class="textarea_top_left">').append($('<div class="textarea_top_right">').append($('<div class="textarea_top">').append("&nbsp;")));
            $el.before($(ta_top));
            var ta_bottom = $('<div class="textarea_bottom_left">').append($('<div class="textarea_bottom_right">').append($('<div class="textarea_bottom">')));
            $el.after($(ta_bottom));
            $el.wrap(divTag);
            $el.parent('div').addClass('textarea_left');
            $el.wrap(divTag);
            $el.parent('div').addClass('textarea_right');
            $el.wrap(divTag);
            $el.parent('div').addClass('textarea_padding');

			$el.bind("focus",function(event) {
                $(this).closest(".textareaclass").parent('div').addClass(options.focusClass);
			});
			$el.bind("blur",function(event) {
                $(this).closest(".textareaclass").parent('div').removeClass(options.focusClass);
			});

			/*$el.bind("mouseenter",function(event) {
				$el.addClass(options.hoverClass);
				$el.closest(".textareaclass").find("div").addClass(options.hoverClass);
			});
			$el.bind("mouseleave",function(event) {
				$el.removeClass(options.hoverClass);
				$el.closest(".textareaclass").find("div").removeClass(options.hoverClass);
			});*/

			/*if($el.is(":disabled")) {
                $el.closest(".textareaclass").parent('div').addClass(options.disabledClass);
			}*/
			
			storeElement(elem);
		}
		
		function doRadio(elem){
			var $ele = $(elem);
			
			var divTag = $('<div />'), spanTag=$('<span />');
			elem.wrap(divTag);
			divTag.addClass(options.radioClass);
			
			elem.css('opacity', 0);
			
			elem.wrap(divTag);
			elem.wrap(spanTag);
			//redefine variables
			spanTag = elem.parent("span");
			divTag = spanTag.parent("div");
			
			$(elem).bind("click",function(){
				if(elem.attr("checked")) {
					var classes = options.radioClass.split(" ")[0];
					$("." + classes + " span." + options.checkedClass + ":has([name='" + $(elem).attr('name') + "'])").removeClass(options.checkedClass);
					spanTag.addClass(options.checkedClass);
				} else {
					spanTag.removeClass(options.checkedClass);
				}
				spanTag.removeClass(options.focusClass);
			});
			/*$(elem).bind("focus",function(event) {
				spanTag.addClass(options.focusClass);
			});
			$(elem).bind("blur",function(event) {
				spanTag.removeClass(options.focusClass);
			});
			$(elem).bind("mouseenter",function(event) {
				spanTag.addClass(options.hoverClass);
			});
			$(elem).bind("mouseleave",function(event) {
				spanTag.removeClass(options.hoverClass);
			});*/

			if($(elem).attr("checked")) {
				spanTag.addClass(options.checkedClass);
			}
		
		  //handle disabled state
			if($(elem).attr("disabled")){
				divTag.addClass(options.disabledClass);//box is checked by default, check our box
			}
			storeElement(elem);
		}
		
		function doCheckbox(elem) {
			var $ele = $(elem);
			
			var divTag = $('<div />'), spanTag=$('<span />');
			elem.wrap(divTag);
			divTag.addClass(options.checkboxClass);
			
			elem.css('opacity', 0);
			elem.wrap(divTag);
			elem.wrap(spanTag);
			
			//redefine variables
			spanTag = elem.parent("span");
			divTag = spanTag.parent("div");
			
			$(elem).bind("click",function(){
				if(elem.attr("checked")) {
					spanTag.addClass(options.checkedClass);
				} else {
					spanTag.removeClass(options.checkedClass);
				}
				spanTag.removeClass(options.focusClass);
			});

			/*$(elem).bind("focus",function(event) {
				spanTag.addClass(options.focusClass);
			});
			$(elem).bind("blur",function(event) {
				spanTag.removeClass(options.focusClass);
			});*/
			/*$(elem).bind("mouseenter",function(event) {
				spanTag.addClass(options.hoverClass);
			});
			$(elem).bind("mouseleave",function(event) {
				spanTag.removeClass(options.hoverClass);
			});*/

			if($(elem).attr("checked")) {
				spanTag.addClass(options.checkedClass);
			}
			
			if($(elem).attr("disabled")){
				divTag.addClass(options.disabledClass);
			}
			storeElement(elem);
		}

        function doFileType(elem) {
            var $el = $(elem);
            var eleWidth = $el.width();
            // In IE uploader width is 6px less so
            //if ($.browser.msie){
            //	eleWidth += 6;
            //}
            //var uploaderWidth = eleWidth - 15;
            //var actionWidth = 75;
            //var spanWidth = eleWidth - actionWidth - 15;
            var divTag = $('<div />'),
                divTagLeft = $('<div />'),
            //filenameTag = $('<span style="width:'+spanWidth+'px;">'+options.fileDefaultText+'</span>'),
                filenameTag = $('<span>'+options.fileDefaultText+'</span>');
            //btnTag = $('<span>'+options.fileBtnText+'</span>');
            $el.wrap(divTag);
            $el.parent('div').addClass('uploader_middle');
            divTagLeft.addClass(options.fileClassLeft);//.css("width",uploaderWidth);
            divTag.addClass(options.fileClass);
            filenameTag.addClass(options.filenameClass);
            //btnTag.addClass(options.fileBtnClass);

            //wrap with the proper elements
            $el.attr('size','1');
            $el.wrap(divTagLeft);
            $el.wrap(divTag);
            //$el.after(btnTag);
            $el.after(filenameTag);

            //redefine variables
            divTag = $el.closest("div");
            filenameTag = $el.siblings("."+options.filenameClass);
            btnTag = $el.siblings("."+options.fileBtnClass);
            $el.closest("div").attr('align','right');

            //actions
            var setFilename = function(){
                var filename = $el.val();
                if (filename==='') {
                    filename = options.fileDefaultText;
                } else {
                    filename = filename.split(/[\/\\]+/);
                    filename = filename[(filename.length-1)];
                }
                filenameTag.text(filename);
            };

            // Account for input saved across refreshes
            setFilename();

            // IE7 doesn't fire onChange until blur or second fire.
            if ($.browser.msie){
                // IE considers browser chrome blocking I/O, so it
                // suspends tiemouts until after the file has been selected.
                $el.bind('keypress', function(event) {
                    if(event.which==13) {
                        $el.trigger("click");
                    }
                });
                $el.bind('click', function() {
                    setTimeout(setFilename, 0);
                });
            }else{
                $el.bind('change', setFilename);// All other browsers behave properly
            }
            $(elem).bind("focus",function(event) {
                divTag.addClass(options.focusClass);

            });
            $(elem).bind("blur",function(event) {
                divTag.removeClass(options.focusClass);
            });
            $(elem).bind("mouseenter",function(event) {
                divTag.addClass(options.hoverClass);
            });
            $(elem).bind("mouseleave",function(event) {
                divTag.removeClass(options.hoverClass);
            });
            //handle defaults
            if($el.attr("disabled")){
                divTag.parent('div').addClass(options.disabledClass);
            }
            $(elem).bind("change", function(){
                setFilename();
                //$("form").validate().element($el);
            });

            $el.parent('div.uploader').children('span.filename').bind('click', function() {
                $el.trigger('click');
            });
            $el.css('width','100%');
            storeElement(elem);
        }

		function doButton(elem) {
			var $el = $(elem);
			var divTag = $("<div>"),
			  spanTag = $("<span>");

			divTag.addClass(options.buttonClass);
			//divTag.css("width",$el.width()+"px");
			var btnText;

			//if($el.is("a") || $el.is("button")){
			if($el.is("button")){
				btnText = $el.html();
			}else if($el.is(":submit") || $el.is(":reset") || $el.is("input[type=button]")){
				btnText = $el.attr("value");
			}

			btnText = btnText == "" ? $el.is(":reset") ? "Reset" : "Submit" : btnText;
			//spanTag.html(btnText);
			//$el.after(btnText);
			$el.css("opacity", 0);
			$el.wrap(divTag);
			$el.wrap(spanTag);
			$el.before(btnText);
			//redefine variables
			divTag = $el.closest("div");
			spanTag = $el.closest("span");
			var divWidth = spanTag.width();

			divTag.css("width",(divWidth+42)+"px");

			if($el.is(":disabled")) divTag.addClass(options.disabledClass);
			divTag.bind("click", function(e){
				if($(e.target).is("span") || $(e.target).is("div")){
				if(elem[0].dispatchEvent){
					  var ev = document.createEvent('MouseEvents');
					  ev.initEvent( 'click', true, true );
					  elem[0].dispatchEvent(ev);
					}else{
					  elem[0].click();
					}
				}
			});
			//$el.css("width",(divWidth+50)+"px");
			$el.css("height","40px");
			$(elem).bind("focus",function(event) {
				divTag.addClass(options.focusClass);
			});
			$(elem).bind("blur",function(event) {
				divTag.removeClass(options.focusClass);
			});
			$(elem).bind("mouseenter",function(event) {
				divTag.addClass(options.focusClass);
			});
			$(elem).bind("mouseleave",function(event) {
				divTag.removeClass(options.focusClass);
			});

			storeElement(elem);
		}
		function doAnchor(elem) {
			var ele = $(elem);

			var btnText = $(elem).text();
			var anchorWidth = $(elem).width();
			var structure = '<div class="'+ options.buttonClass +'"><span>'+ btnText +'</span></div>';
			$(elem).html(structure);
			$(elem).find('div').css("width", (anchorWidth+60)+"px");
			//$(elem).css("width", (anchorWidth+60)+"px");
			storeElement(elem);
		}

		function storeElement(elem){
			elem = $(elem).get(); //store this element in our global array
			if(elem.length > 1){
				$.each(elem, function(i, val){
					options.elements.push(val);
				});
			}else{
				options.elements.push(elem);
			}
		}
	}

    function ellipsis(element, text, width) {
        var spanelement = '<span style="display:none;white-space:nowrap;" id="tempspan">'+text+'</span>';
        $(element).after(spanelement);
        var ellipsistext = text;
        //alert($("#tempspan").width() + "," + $(element).width());
        if($("#tempspan").width() > $(element).width()) {
            var i = 1;
            $("#tempspan").html('');

            while($("#tempspan").width() < ($(element).width()-60) && i < text.length) {
                ellipsistext= text.substr(0,i) + '...';
                $("#tempspan").html(ellipsistext);
                i++;
            }
        }
        $("#tempspan").remove();
        return ellipsistext;
    }

	$.fn.csform.update = function(elem) {
	  var options=$.fn.csform.defaults;
      if(elem == undefined){
        elem = $($.fn.csform.defaults.elements);
      }
      //sanitize input
      elem = $(elem);

      elem.each(function(){

        var $e = $(this);

        if($e.is("select")){
			var spanTag = $e.siblings("span");
			var divTag = $e.parent("div");

            var text = ellipsis(divTag, $e.find(":selected").html(), $(divTag).width());
            spanTag.html(text);

			if($e.is(":disabled")){
                $e.closest('.selector').parent('div').addClass(options.disabledClass);
			}else{
                $e.closest('.selector').parent('div').removeClass(options.disabledClass);
			}

        }else if($e.is(":checkbox")){
			var spanTag = $e.closest("span");
			var divTag = $e.closest("div");
			if($e.is(":checked")){
				spanTag.addClass(options.checkedClass);
			} else {
				spanTag.removeClass(options.checkedClass);
			}

			if($e.is(":disabled")){
				divTag.addClass(options.disabledClass);
			}else{
				divTag.removeClass(options.disabledClass);
			}

        }else if($e.is(":radio")){
			var spanTag = $e.closest("span");
			var divTag = $e.closest("div");

			if($e.is(":checked")){
				spanTag.addClass(options.checkedClass);
			} else {
				spanTag.removeClass(options.checkedClass);
			}

			if($e.is(":disabled")){
				divTag.addClass(options.disabledClass);
			}else{
				divTag.removeClass(options.disabledClass);
			}
        }else if($e.is(":file")){
			var divTag = $e.parent("div");
			var filenameTag = $e.siblings(options.filenameClass);

			if($e.is(":disabled")){
                $e.closest('.uploaderleft').parent('div').addClass(options.disabledClass);
			}else{
                $e.closest('.uploaderleft').parent('div').removeClass(options.disabledClass);
			}
        }else if($e.is(":submit") || $e.is(":reset") || $e.is("button") || $e.is("a") || elem.is("input[type=button]")){
			var divTag = $e.closest("div");

			if($e.is(":disabled")){
				divTag.addClass(options.disabledClass);
			}else{
				divTag.removeClass(options.disabledClass);
			}
        }
		else if($e.is(":text, :password, input[type='email']")){
			//var divTag = $e.parent("div");
			$e.parent('div').removeClass(options.focusClass);
			if($e.is(":disabled")){
                $e.closest('.inputleft').parent('div').addClass(options.disabledClass);
			}else{
                $e.closest('.inputleft').parent('div').removeClass(options.disabledClass);
			}
        }
		else if($e.is("textarea")){
			var divTag = $e.parent("div");

			if($e.is(":disabled")){
                $e.closest(".textareaclass").parent('div').addClass(options.disabledClass);
			}else{
                $e.closest(".textareaclass").parent('div').removeClass(options.disabledClass);
			}
        }
      });
	}

	$.fn.csform.defaults = {
		selectClass:'selector',
        selectright:'selector_right',
		radioClass:'radio',
		checkedClass:'checked',
		checkboxClass:'checker',
		disabledClass:'disabled',
		fileClass: 'uploader',
		fileClassLeft: 'uploaderleft',
		filenameClass: 'filename',
		fileBtnClass: 'action',
		fileBtnText: '',
		fileDefaultText: 'No file selected ',
		buttonClass: 'button',
		elements: [],
		focusClass: 'focus',
		hoverClass: 'hover',
		onCombovaluechanged: function(){}
	};
})(jQuery);