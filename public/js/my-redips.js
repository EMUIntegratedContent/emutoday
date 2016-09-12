/*jslint white: true, browser: true, undef: true, nomen: true, eqeqeq: true, plusplus: false, bitwise: true, regexp: true, strict: true, newcap: true, immed: true, maxerr: 14 */
/*global window: false, REDIPS: true */

/* enable strict mode */
"use strict";

// define init and show methods
var redipsInit,
	showContent,
	getContent,
	startPositions,		// remember initial positions of DIV elements
	checkAndSetStoryPositions,
	loc = {},			// initial locations of DIV elements
	lock = 0,
	reset,				// returns elements to their initial positions
	enableElements,		// enables/disables elements on page
	enableRows,			// enables/disables rows (row handler - blue circles) on page
	enableButtons,		// enables/disables buttons (called from enable elements and enableRows)
	getId,				// returns id of element in opposite table
			// needed for enable/disable element synchronization (used in enableRows)
	// pos = {},
	story_ids = [],
	rd = REDIPS.drag;

// redips initialization
redipsInit = function () {
	var num = 0,			// number of successfully placed elements
		rd = REDIPS.drag;	// reference to the REDIPS.drag lib

	// initialization
	rd.init();
	// enable shift animation
	//rd.shift.animation = true;
	// save initial DIV positions to "pos" object (it should go after initialization)
	startPositions();

	// set hover color
	rd.hover.colorTd = '#9BB3DA';
	// call initially showContent
	showContent();
	// on each drop refresh content
	rd.event.dropped = function () {
		showContent();
	};
	// call showContent() after DIV element is deleted
	rd.event.deleted = function () {
		showContent();
	};
	// when DIV element is double clicked return it to the initial position
	rd.event.dblClicked = function () {
		// set dblclicked DIV id
		var id = rd.obj.id;
		// move DIV element to initial position
		rd.moveObject({
			id: id,			// DIV element id
			target: loc[id],	// target position
			callback: showContent
		});
		// call showContent() after DIV element is returned
		showContent();
	};

	checkAndSetStoryPositions();
};



// show TD content
showContent = function () {
	// get content of TD cells in right table
	var emuhome0 = getContent('emuhome0'),
		emuhome1 = getContent('emuhome1'),
		emuhome2 = getContent('emuhome2'),
		emuhome3 = getContent('emuhome3'),
		emuhome4 = getContent('emuhome4'),
		// set reference to the message DIV (below tables)
		message = document.getElementById('message');
		story_ids[0] = emuhome0;
		story_ids[1] = emuhome1;
		story_ids[2] = emuhome2;
		story_ids[3] = emuhome3;
		story_ids[4] = emuhome4;

	// show block content
	message.innerHTML = 'Main Featured Story = ' + emuhome0 + '<br>' +
						'Featured Story 1 = ' + emuhome1 + '<br>' +
						'Featured Story 2 = ' + emuhome2 + '<br>' +
						'Featured Story 3 = ' + emuhome3 + '<br>' +
						'Featured Story 4 = ' + emuhome4;

	document.getElementById("story_ids").value = story_ids.toString();
};

// function scans DIV elements and saves their positions to the "pos" object
startPositions = function () {
	// define local varialbles
	var divs, id, i, position;
	// collect DIV elements from dragging area
	divs = document.getElementById('redips-drag').getElementsByTagName('div');
	// open loop for each DIV element
	for (i = 0; i < divs.length; i++) {

		// set DIV element id
		id = divs[i].id;
		// if element id is defined, then save element position
		if (id) {
			//if (id.substr(0, 1) === 'x') {
			if (id.substr(id.length - 1) === 'x') {
			rd.mark.exception[id] = 'hero';
			}
			// set element position
			position = rd.getPosition(divs[i]);
			// if div has position (filter obj_new)
			if (position.length > 0) {
				loc[id] = position;
			}
		}
	}
};
//move items after set
checkAndSetStoryPositions = function() {
	var sindex;
	var sop = JSvars.storysonpage;
	for (sindex = 0; sindex < sop.length ; sindex++ ) {
		var srcCell, tarCell;
		console.log(sop[sindex].id + '   ' + sop[sindex].pivot.page_position);
		if (sop[sindex].pivot.page_position == 0) {
			document.getElementById('emuhome0').appendChild(
				document.getElementById('drag-'+ sop[sindex].id + 'x')
			);

			// srcCell = document.getElementById('drag-'+ sop[sindex].id + 'x');
			// tarCell = document.getElementById('emuhome0');

		} else {

				document.getElementById('emuhome'+ sop[sindex].pivot.page_position).appendChild(
					document.getElementById('drag-'+ sop[sindex].id)
			);
			// srcCell = document.getElementById('drag-'+ sop[sindex].id);
			// tarCell = document.getElementById('emuhome' + sop[sindex].pivot.page_position);
		}
		//console.log('srcCell= '+ srcCell + ' tarCell= '+ tarCell);
		//srcCell.style.color = "red";

		// rd.relocate(srcCell,tarCell,'animation');
	}
	showContent();

}

/**
 * Method returns element to initial positions.
 */
reset = function () {
	var id,
		pos1;
	// loop goes through every "id" in loc object
	for (id in loc) {
		// test the property (filter properties of the prototype) and if element id begins with "d"
		// other DIV elements are row handlers
		if (loc.hasOwnProperty(id) && id.substring(0, 1) === 'd') {
			// get current position of element
			pos1 = rd.getPosition(id);
			// if current position is different then initial position the return element to the initial position
			if (loc[id].toString() !== pos1.toString()) {
				// disable row handlers - blue circles
				enableRows(false);
				// move object to the initial position
				rd.moveObject({
					id: id,					// id of object to move
					target: loc[id],		// target position
					callback: enableRows	// callback function after moving is finished
				});
			}
		}
	}
};
// get content (DIV elements in TD)
getContent = function (id) {
	var td = document.getElementById(id),
		content = '',
		imgname,imgtype,imgurl,
		cn, i;
	// TD can contain many DIV elements
	for (i = 0; i < td.childNodes.length; i++) {
		// set reference to the child node
		cn = td.childNodes[i];
		// childNode should be DIV with containing "drag" class name
		if (cn.nodeName === 'DIV' && cn.className.indexOf('drag') > -1) { // and yes, it should be uppercase
			// append DIV id to the result string
			content += cn.id + '_';
			imgname = cn.dataset.imgname;
			imgtype = 'dd' + cn.dataset.imgtype;
			imgurl = 'url(/imagecache/'+ imgtype + '/' + imgname + ')';
			console.log('fnameurl'+ imgurl);
		}
	}
	// cut last '_' from string
	content = content.substring(0, content.length - 1);

	content = content.replace('x','');
	// if (content.substr(0, content.length - 1) === 'x') {
	// 	content = content.substr(0, content.length - 1);
	// }
	if (content.length === 0){
		content = 0;
		td.style.backgroundColor = 'red';
			td.style.backgroundImage = '';
	} else {
		content = content.replace('drag-','');
		td.style.backgroundColor = 'blue';
		td.style.backgroundImage = imgurl;
		td.style.backgroundRepeat = 'no-repeat';
		console.log('content='+ content);
	}
	//
	//console.log('content.length' + content.length);
	// return result

	return content;
};


/**
 * Function returns "id" of element in opposite table.
 * e.g. d2_1 -> d2_2 or d4_2 -> d4_1
 * @param {HTMLElement} DIV element (in row dragging context "el" is redips-rowhandler of source row)
 * @return {String} Id of element in opposite table.
 */
getId = function (el) {
	var	ri = {1: 2, 2: 1},						// needed for reverse 1 -> 2 or 2 -> 1
		id = el.id,								// define DIV id or mini table
		lc = id.charAt(id.length - 1),			// last character of id that should be reversed (1 -> 2 or 2 -> 1)
		idNew = id.slice(0, -1) + ri[lc];		// id of element from opposite table
	// return new id
	return idNew;
};


/**
 * Function enables/disables buttons and all elements on page. In case when user drops row, elements (and rows) are disabled until animation finishes.
 * @param {Boolean} Flag enable or disable elements in both dragging containers.
 */
enableElements = function (flag) {
	rd.enableDrag(flag, '#drag1 div');
	rd.enableDrag(flag, '#drag2 div');
	// enable/disable buttons "Reset" and "Shuffle"
	enableButtons(flag);
};
/**
 * Function enables/disables rows and buttons on page. In case when user drops element, row handlers are disabled until all animations are finished.
 * "lock" variable is used for animation synchronization.
 * @param {Boolean} Flag enable or disable rows in both dragging containers.
 */
enableRows = function (flag) {
	var id;
	// if input parameter is not boolean type, then enableRows is called from callback function
	// callback function sends reference of moved element
	if (typeof(flag) !== 'boolean') {
		flag = true;
	}
	// enable element - decrease lock variable
	if (flag) {
		lock--;
	}
	// if lock variable is 0 (condition "lock === 0" will be fine)
	if (lock <= 0) {
		// set lock variable to 0 (just to be sure - it should be 0 anyway)
		lock = 0;
		// enable / disable buttons "Reset" and "Shuffle"
		enableButtons(flag);
		// loop goes through every "id" in loc object
		for (id in loc) {
			// test the property (filter properties of the prototype) and if element id begins with "r"
			// other DIV elements are DIV elements
			if (loc.hasOwnProperty(id) && id.substring(0, 1) === 'r') {
				rd.enableDrag(flag, '#' + id);
			}
		}
	}
	// after element is dropped, it will be disabled first (so this code is executed first in enableRows() function)
	if (!flag) {
		lock++;
	}
	console.log('enableRows');
	showContent();
};

/**
 * Function enables/disables buttons (it's called from enableElements() and enableRows() functions)
 * @param {Boolean} Flag enable or disable buttons.
 */
enableButtons = function (flag) {
	var buttons, i;
	// collect buttons from buttons area
	buttons = document.getElementById('buttons').getElementsByTagName('input');
	// open loop
	for (i = 0; i < buttons.length; i++) {
		buttons[i].disabled = !flag;
	}
};
// indexOf method - needed for IE browsers ?!
if (!Array.prototype.indexOf) {
	Array.prototype.indexOf = function (el) {
		var i; // local variable
		for (i = 0; i < this.length; i++) {
			if (this[i] === el) {
				return i;
			}
		}
		return -1;
	};
}

// add onload event listener
if (window.addEventListener) {
	window.addEventListener('load', redipsInit, false);
}
else if (window.attachEvent) {
	window.attachEvent('onload', redipsInit);
}
