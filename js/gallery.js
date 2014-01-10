$(function () {
  $(".items .img").hover(function (e) {
    var _this  = $(this), 
        _desc  = _this.find(".desc").stop(true),
        width  = _this.width(),
        height = _this.height(), 
        left   = e.offsetX, 
        top    = e.offsetY, 
        right  = width - left,
        bottom = height - top, 
        rect   = {}, 
        _min   = Math.min(left, top, right, bottom), 
        _out   = e.type == "mouseleave", 
        spos   = {}; 

    rect[left] = function (epos) { 
      spos = {"left": -width, "top": 0};
      if (_out) {
        _desc.animate(spos, "fast"); 
      } else {
        _desc.css(spos).animate(epos, "fast"); 
      }
    };

    rect[top] = function (epos) { 
      spos = {"top": -height, "left": 0};
      if (_out) {
        _desc.animate(spos, "fast"); 
      } else {
        _desc.css(spos).animate(epos, "fast"); 
      }
    };

    rect[right] = function (epos) { 
      spos = {"left": left,"top": 0};
      if (_out) {
        _desc.animate(spos, "fast"); 
      } else {
         _desc.css(spos).animate(epos, "fast"); 
      }
    };
    
    rect[bottom] = function (epos) { 
      spos = {"top": height, "left": 0};
      if (_out) {
        _desc.animate(spos, "fast"); 
      } else {
        _desc.css(spos).animate(epos, "fast");
      }
    };

    rect[_min]({"left":0, "top":0}); 
  });
});