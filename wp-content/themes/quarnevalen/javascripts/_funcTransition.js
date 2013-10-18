// ————————————————————————————- //
// VARIABLES
// ————————————————————————————- //
var $main = $( '#pt-main' ),
$pages = $main.children( 'div.pt-page' ),
$iterate = $( '#Page-Transition' ), // <- ID for my button
pagesCount = $pages.length,
current = 0,
isAnimating = false,
endCurrPage = false,
endNextPage = false,
animEndEventNames = {
'WebkitAnimation' : 'webkitAnimationEnd',
'OAnimation' : 'oAnimationEnd',
'msAnimation' : 'MSAnimationEnd',
'animation' : 'animationend'
},
// animation end event name
animEndEventName = animEndEventNames[ Modernizr.prefixed( 'animation' ) ],
// support css animations
support = Modernizr.cssanimations;
function onEndAnimation( $outpage, $inpage ) {
endCurrPage = false;
endNextPage = false;
resetPage( $outpage, $inpage );
isAnimating = false;
}
function resetPage( $outpage, $inpage ) {
$outpage.attr( 'class', $outpage.data( 'originalClassList' ) );
$inpage.attr( 'class', $inpage.data( 'originalClassList' ) + ' pt-page-current' );
}
// ————————————————————————————- //
// loadNextPage
// ————————————————————————————- //
function loadNextPage() {
if( isAnimating ) {
return false;
}
isAnimating = true;
var $currPage = $pages.eq( current );
// if 0 < page < nb_page then ++
if( current < pagesCount - 1 ) {
++current;
}
else {
current = 0;
}
// I use only 1 animation style that's why I deleted switch animation
var $nextPage = $pages.eq( current ).addClass( 'pt-page-current' ),
outClass = 'pt-page-moveToTopEasing pt-page-ontop', inClass = 'pt-page-moveFromBottom';
$currPage.addClass( outClass ).on( animEndEventName, function() {
$currPage.off( animEndEventName );
endCurrPage = true;
if( endNextPage ) {
onEndAnimation( $currPage, $nextPage );
}
} );
$nextPage.addClass( inClass ).on( animEndEventName, function() {
$nextPage.off( animEndEventName );
endNextPage = true;
if( endCurrPage ) {
onEndAnimation( $currPage, $nextPage );
}
} );
if( !support ) {
onEndAnimation( $currPage, $nextPage );
}
}
// ————————————————————————————- //
// loadPreviousPage
// ————————————————————————————- //
function loadPreviousPage() {
if( isAnimating ) {
return false;
}
isAnimating = true;
var $currPage = $pages.eq( current );
// if i'm on page1, i'll go page to last page (edit 3 by your last page)
if( current == 0 ) {
current = pagesCount-1;
}
// if 1 < page <= nb_page then-
else if( current <= pagesCount - 1 ) {
--current;
}
// else go to page1
else {
current = 0;
}
// I use only 1 animation style that's why I deleted switch animation
var $prevPage = $pages.eq( current ).addClass( 'pt-page-current' ),
outClass = 'pt-page-moveToBottomEasing pt-page-ontop', inClass = 'pt-page-moveFromTop';
$currPage.addClass( outClass ).on( animEndEventName, function() {
$currPage.off( animEndEventName );
endCurrPage = true;
if( endNextPage ) {
onEndAnimation( $currPage, $prevPage );

}
} );
$prevPage.addClass( inClass ).on( animEndEventName, function() {
$prevPage.off( animEndEventName );
endNextPage = true;
if( endCurrPage ) {
onEndAnimation( $currPage, $prevPage );
}
} );
if( !support ) {
onEndAnimation( $currPage, $prevPage );
}
}
// ————————————————————————————- //
// gotoPage(x) - Specific page
// ————————————————————————————- //
function gotoPage(pagenumber) {
if( isAnimating ) {
return false;
}
isAnimating = true;
var $currPage = $pages.eq( current );
// If page is different than page-number, then go to page-number
if( current != pagenumber ) {
current = pagenumber;
}
var $prevPage = $pages.eq( current ).addClass( 'pt-page-current' ),
outClass = 'pt-page-moveToBottomEasing pt-page-ontop', inClass = 'pt-page-moveFromTop';
$currPage.addClass( outClass ).on( animEndEventName, function() {
$currPage.off( animEndEventName );
endCurrPage = true;
if( endNextPage ) {
onEndAnimation( $currPage, $prevPage );
}
} );
$prevPage.addClass( inClass ).on( animEndEventName, function() {
$prevPage.off( animEndEventName );
endNextPage = true;
if( endCurrPage ) {
onEndAnimation( $currPage, $prevPage );
}
} );
if( !support ) {
onEndAnimation( $currPage, $prevPage );
}
}