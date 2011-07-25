function Pos(x,y)
{
    this.x = x;
    this.y = y;
}

function getAbsPos( el, bNoBody )
{
    if( !el ) return;

    var pos = new Pos(el.offsetLeft - el.scrollLeft, el.offsetTop - el.scrollTop);
    var elParent = typeof el.offsetParent == "object" ? el.offsetParent : null;
    var s;

    while( elParent != null && elParent.nodeName != "#document")
    {
        pos.x += elParent.offsetLeft - elParent.scrollLeft;
        pos.y += elParent.offsetTop - elParent.scrollTop;
        elParent = elParent.offsetParent;
    }
    // add body scroll offset
    if( !bNoBody ){
        pos.x += elGetOwnerDoc(el).body.scrollLeft;
        pos.y += elGetOwnerDoc(el).body.scrollTop;
    }
    return pos;
}

function elGetOwnerDoc(el) 
{
    return (!el.ownerDocument ? el.document : el.ownerDocument); 
}