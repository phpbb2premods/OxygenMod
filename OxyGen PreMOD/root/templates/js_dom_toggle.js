function _dom_toggle()
{
	return this;
}
	_dom_toggle.prototype.objref = function(id)
	{
		return document.getElementById ? document.getElementById(id) : (document.all ? document.all[id] : (document.layers ? document.layers[id] : null));
	}

	_dom_toggle.prototype.cancel_event = function()
	{
		if ( window.event )
		{
			window.event.cancelBubble = true;
		}
	}

	_dom_toggle.prototype.toggle = function(id, close_id, open_icon, close_icon)
	{
		var open_object = this.objref(id);
		var close_object = this.objref(close_id);

		if ( open_object && open_object.style )
		{
			open_object.style.display = (open_object.style.display == 'none') ? '' : 'none';
			if ( close_object && close_object.style )
			{
				close_object.style.display = (open_object.style.display == 'none') ? '' : 'none';
			}
			if ( close_object && close_object.src )
			{
				close_object.src = (open_object.style.display == 'none') ? open_icon : close_icon;
			}
		}
		this.cancel_event();
	}

// instantiate
dom_toggle = new _dom_toggle();
