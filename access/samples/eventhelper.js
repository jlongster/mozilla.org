
function eventGet(ev){
	return (ev)? ev: window.event;
}



function eventGetTarget(ev) {
    ev = eventGet(ev);
    if(!ev)
        return null;
    if(ev.srcElement)
        return ev.srcElement;
    else if(ev.target)
    {
        var target = ev.target;
        try {
            while(target && target.nodeName == '#text')
                target = target.parentNode;
            return target;
        } catch(e) {
            return null;
        }
    }
}