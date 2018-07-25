function findObj(objId)
{
	var element = objId;
	if (document.getElementById)
	{
		element = document.getElementById(objId);
	}
	else if (document.all)
	{
		element = document.all[objId];
	}
	else if (document.layers)
	{
		element = document.layers[objId];
	}
	return element;
}

function objSwitch(objId)
{
	if( element = findObj(objId) )
	{
		if(element.style.display == '')
		{
			element.style.display = 'none';
		}
		else
		{
			element.style.display = '';
		}
	}
}

function objHide(objId)
{
	if( element = findObj(objId) )
	{
		if(element.style.display == '')
		{
			element.style.display = 'none';
		}
	}
}

function objShow(objId)
{
	if( element = findObj(objId) )
	{
		if(element.style.display == 'none')
		{
			element.style.display = '';
		}
	}
}