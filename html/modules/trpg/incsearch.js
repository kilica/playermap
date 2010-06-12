//http://rt.air-nifty.com/blog/2009/10/jquery-iechrome.html
String.prototype.quoteMeta = function() {
	return this.replace(/(\W)/g, '\\$1');
}

$.fn.extend({
	add_incsearch_on: function(target,arr,base) {
		//var children = target.children();

		this.keyup(function() {
			if(($(this).val().length==0)){
				target.empty();
				return;
			}
			var pattern   = new RegExp($(this).val().quoteMeta(), "i");
			var items = $.map(arr.title, function(obj, idx) {
				return pattern.test(obj+arr.search[idx]) ? {"title":obj,"id":arr.id[idx]} : null;
			});
		
			target.empty();
			$.each(items,function(idx,obj){
				$('<li></li>').wrapInner('<a href="'+base+obj.id+'">'+obj.title+'</a>').appendTo(target);
			});
		});
	}
});
