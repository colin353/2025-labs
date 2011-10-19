/*
 *	Shim jQuery Plug-in $Revision: 3 $
 *	<https://sourceforge.net/projects/jqueryshim>
 *	
 *	Copyright (c) 2010 Dave Willkomm
 *	Licensed under the MIT License
 *	<http://www.opensource.org/licenses/mit-license.php>
 */
(function($) {
	
	$.fn.shim = function()
	{
		if (!$.browser.webkit)
		{
			this.each(function()
			{
				var
					element = $(this),
					offset = element.offset(),
					html = '<iframe class="jQshim" frameborder="0" style="' +
						'display: block;'+
						'position: absolute;' +
						'top:' + offset.top + 'px;' +
						'left:' + offset.left + 'px;' +
						'width:' + element.outerWidth() + 'px;' +
						'height:' + element.outerHeight() + 'px;' +
						'z-index:' + Number.MAX_VALUE + ';' +
						'"/>';
				
				element.before(html);
			});
		}
		
		return this;
	};
	
	$.fn.unshim = function()
	{
		if (!$.browser.webkit)
		{
			this.each(function()
			{
				$(this).prev("iframe.jQshim").remove();
			});
		}
		
		return this;
	};
	
})(jQuery);
