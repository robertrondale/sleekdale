/**
 * Add the ff. class in the section to make the video worked
 *
 * 1. Video tag should have .js-video-tag
 *
 * 2. The parent container should have .js-video (Ideally, this should
 * be added in the div that holds all the content like text, video,
 * images and play button)
 *
 * 3. Add .js-hide-on-play to the elements you want to hide when the
 * video is played
 *
 * 4. The element you want to set as trigger to play/pause the video should have
 * .js-playvideo. This is mostly added in the play button.
 *
 * 5. You can add js-play if you want an image to show if video is paused.
 *
 */

const selector = {
  hideOnPlay: ".js-hide-on-play",
  container: ".js-video",
};

const classes = {
  hide: "d-none",
  playButton: "js-playvideo",
};

const isAutoplaySupported = (callback) => {
  if (!sessionStorage.autoPlaySupported) {
    let video = document.createElement("video");
    video.autoplay = true;
    video.muted = true;
    video.setAttribute("webkit-playsinline", "webkit-playsinline");
    video.setAttribute("playsinline", "playsinline");
    video.src =
      "data:video/mp4;base64,AAAAIGZ0eXBtcDQyAAAAAG1wNDJtcDQxaXNvbWF2YzEAAATKbW9vdgAAAGxtdmhkAAAAANLEP5XSxD+VAAB1MAAAdU4AAQAAAQAAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgAAACFpb2RzAAAAABCAgIAQAE////9//w6AgIAEAAAAAQAABDV0cmFrAAAAXHRraGQAAAAH0sQ/ldLEP5UAAAABAAAAAAAAdU4AAAAAAAAAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAAAAAAABAAAAAAoAAAAFoAAAAAAAkZWR0cwAAABxlbHN0AAAAAAAAAAEAAHVOAAAH0gABAAAAAAOtbWRpYQAAACBtZGhkAAAAANLEP5XSxD+VAAB1MAAAdU5VxAAAAAAANmhkbHIAAAAAAAAAAHZpZGUAAAAAAAAAAAAAAABMLVNNQVNIIFZpZGVvIEhhbmRsZXIAAAADT21pbmYAAAAUdm1oZAAAAAEAAAAAAAAAAAAAACRkaW5mAAAAHGRyZWYAAAAAAAAAAQAAAAx1cmwgAAAAAQAAAw9zdGJsAAAAwXN0c2QAAAAAAAAAAQAAALFhdmMxAAAAAAAAAAEAAAAAAAAAAAAAAAAAAAAAAoABaABIAAAASAAAAAAAAAABCkFWQyBDb2RpbmcAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP//AAAAOGF2Y0MBZAAf/+EAHGdkAB+s2UCgL/lwFqCgoKgAAB9IAAdTAHjBjLABAAVo6+yyLP34+AAAAAATY29scm5jbHgABQAFAAUAAAAAEHBhc3AAAAABAAAAAQAAABhzdHRzAAAAAAAAAAEAAAAeAAAD6QAAAQBjdHRzAAAAAAAAAB4AAAABAAAH0gAAAAEAABONAAAAAQAAB9IAAAABAAAAAAAAAAEAAAPpAAAAAQAAE40AAAABAAAH0gAAAAEAAAAAAAAAAQAAA+kAAAABAAATjQAAAAEAAAfSAAAAAQAAAAAAAAABAAAD6QAAAAEAABONAAAAAQAAB9IAAAABAAAAAAAAAAEAAAPpAAAAAQAAE40AAAABAAAH0gAAAAEAAAAAAAAAAQAAA+kAAAABAAATjQAAAAEAAAfSAAAAAQAAAAAAAAABAAAD6QAAAAEAABONAAAAAQAAB9IAAAABAAAAAAAAAAEAAAPpAAAAAQAAB9IAAAAUc3RzcwAAAAAAAAABAAAAAQAAACpzZHRwAAAAAKaWlpqalpaampaWmpqWlpqalpaampaWmpqWlpqalgAAABxzdHNjAAAAAAAAAAEAAAABAAAAHgAAAAEAAACMc3RzegAAAAAAAAAAAAAAHgAAA5YAAAAVAAAAEwAAABMAAAATAAAAGwAAABUAAAATAAAAEwAAABsAAAAVAAAAEwAAABMAAAAbAAAAFQAAABMAAAATAAAAGwAAABUAAAATAAAAEwAAABsAAAAVAAAAEwAAABMAAAAbAAAAFQAAABMAAAATAAAAGwAAABRzdGNvAAAAAAAAAAEAAAT6AAAAGHNncGQBAAAAcm9sbAAAAAIAAAAAAAAAHHNiZ3AAAAAAcm9sbAAAAAEAAAAeAAAAAAAAAAhmcmVlAAAGC21kYXQAAAMfBgX///8b3EXpvebZSLeWLNgg2SPu73gyNjQgLSBjb3JlIDE0OCByMTEgNzU5OTIxMCAtIEguMjY0L01QRUctNCBBVkMgY29kZWMgLSBDb3B5bGVmdCAyMDAzLTIwMTUgLSBodHRwOi8vd3d3LnZpZGVvbGFuLm9yZy94MjY0Lmh0bWwgLSBvcHRpb25zOiBjYWJhYz0xIHJlZj0zIGRlYmxvY2s9MTowOjAgYW5hbHlzZT0weDM6MHgxMTMgbWU9aGV4IHN1Ym1lPTcgcHN5PTEgcHN5X3JkPTEuMDA6MC4wMCBtaXhlZF9yZWY9MSBtZV9yYW5nZT0xNiBjaHJvbWFfbWU9MSB0cmVsbGlzPTEgOHg4ZGN0PTEgY3FtPTAgZGVhZHpvbmU9MjEsMTEgZmFzdF9wc2tpcD0xIGNocm9tYV9xcF9vZmZzZXQ9LTIgdGhyZWFkcz0xMSBsb29rYWhlYWRfdGhyZWFkcz0xIHNsaWNlZF90aHJlYWRzPTAgbnI9MCBkZWNpbWF0ZT0xIGludGVybGFjZWQ9MCBibHVyYXlfY29tcGF0PTAgc3RpdGNoYWJsZT0xIGNvbnN0cmFpbmVkX2ludHJhPTAgYmZyYW1lcz0zIGJfcHlyYW1pZD0yIGJfYWRhcHQ9MSBiX2JpYXM9MCBkaXJlY3Q9MSB3ZWlnaHRiPTEgb3Blbl9nb3A9MCB3ZWlnaHRwPTIga2V5aW50PWluZmluaXRlIGtleWludF9taW49Mjkgc2NlbmVjdXQ9NDAgaW50cmFfcmVmcmVzaD0wIHJjX2xvb2thaGVhZD00MCByYz0ycGFzcyBtYnRyZWU9MSBiaXRyYXRlPTExMiByYXRldG9sPTEuMCBxY29tcD0wLjYwIHFwbWluPTUgcXBtYXg9NjkgcXBzdGVwPTQgY3BseGJsdXI9MjAuMCBxYmx1cj0wLjUgdmJ2X21heHJhdGU9ODI1IHZidl9idWZzaXplPTkwMCBuYWxfaHJkPW5vbmUgZmlsbGVyPTAgaXBfcmF0aW89MS40MCBhcT0xOjEuMDAAgAAAAG9liIQAFf/+963fgU3DKzVrulc4tMurlDQ9UfaUpni2SAAAAwAAAwAAD/DNvp9RFdeXpgAAAwB+ABHAWYLWHUFwGoHeKCOoUwgBAAADAAADAAADAAADAAAHgvugkks0lyOD2SZ76WaUEkznLgAAFFEAAAARQZokbEFf/rUqgAAAAwAAHVAAAAAPQZ5CeIK/AAADAAADAA6ZAAAADwGeYXRBXwAAAwAAAwAOmAAAAA8BnmNqQV8AAAMAAAMADpkAAAAXQZpoSahBaJlMCCv//rUqgAAAAwAAHVEAAAARQZ6GRREsFf8AAAMAAAMADpkAAAAPAZ6ldEFfAAADAAADAA6ZAAAADwGep2pBXwAAAwAAAwAOmAAAABdBmqxJqEFsmUwIK//+tSqAAAADAAAdUAAAABFBnspFFSwV/wAAAwAAAwAOmQAAAA8Bnul0QV8AAAMAAAMADpgAAAAPAZ7rakFfAAADAAADAA6YAAAAF0Ga8EmoQWyZTAgr//61KoAAAAMAAB1RAAAAEUGfDkUVLBX/AAADAAADAA6ZAAAADwGfLXRBXwAAAwAAAwAOmQAAAA8Bny9qQV8AAAMAAAMADpgAAAAXQZs0SahBbJlMCCv//rUqgAAAAwAAHVAAAAARQZ9SRRUsFf8AAAMAAAMADpkAAAAPAZ9xdEFfAAADAAADAA6YAAAADwGfc2pBXwAAAwAAAwAOmAAAABdBm3hJqEFsmUwIK//+tSqAAAADAAAdUQAAABFBn5ZFFSwV/wAAAwAAAwAOmAAAAA8Bn7V0QV8AAAMAAAMADpkAAAAPAZ+3akFfAAADAAADAA6ZAAAAF0GbvEmoQWyZTAgr//61KoAAAAMAAB1QAAAAEUGf2kUVLBX/AAADAAADAA6ZAAAADwGf+XRBXwAAAwAAAwAOmAAAAA8Bn/tqQV8AAAMAAAMADpkAAAAXQZv9SahBbJlMCCv//rUqgAAAAwAAHVE=";
    video.load();
    video.style.display = "none";
    video.playing = false;

    video.play();

    video.onplay = function () {
      this.playing = true;
    };

    // Video has loaded, check autoplay support
    video.oncanplay = function () {
      if (video.playing) {
        sessionStorage.autoPlaySupported = "true";
        callback(true);
      } else {
        sessionStorage.autoPlaySupported = "false";
        callback(false);
      }
    };
  } else {
    if (sessionStorage.autoPlaySupported == "true") {
      callback(true);
    } else {
      callback(false);
    }
  }
};

const removeElementsOnPlay = (el, opacity, excludeImg = false) => {
  if (!el) {
    return;
  }

  if (!excludeImg) {
    el.find("img:not(.js-play)").css({ opacity: opacity });
  }

  el.find(selector.hideOnPlay).css({ opacity: opacity });
};

const updateVideo = (parent, video) => {
  if (!parent || String(video.dataset.multiple) !== "true") return;

  let images = parent.find("img:visible");

  let src = "desktop";
  if (images.length && images.data("view")) {
    src = images.data("view");
  }

  var data = JSON.parse(video.dataset[src]);
  if (data.autoplay) {
    video.autoplay = true;
    video.muted = true;
  } else {
    video.autoplay = false;
    video.muted = false;
  }

  var source = video.querySelector("source");
  if (data.src != source.src) {
    source.src = data.src;

    removeElementsOnPlay(parent, 1);
    if (images) $(video).css("zIndex", -1);
  }

  video.load();
};

const videoOnClick = (playVideo, videoParent) => {
  if (!playVideo) return;

  playVideo.off("click").on("click", (e) => {
    e.preventDefault();

    let targetParent = $(e.target).parents(selector.container);
    let targetVideo = targetParent.find("video")[0];
    let hasLink = playVideo.hasClass("js-has-link"); //check if video has link
    const excludeImg = $(targetVideo).data("played");

    if (targetVideo.paused == false) {
      targetVideo.pause();
      removeElementsOnPlay(videoParent, 1, excludeImg);
    } else {
      if (hasLink) {
        playVideo.hide();
      }
      targetVideo.play();
      $(targetVideo).data("played", true);
      removeElementsOnPlay(videoParent, 0, excludeImg);
    }

    $(targetVideo).css("zIndex", 0);
  });
};

const flexibleVideo = () => {
  let jsVideo = $("video.js-video-tag");

  if (jsVideo.length === 0) return;

  jsVideo.each(function () {
    let _this = $(this);
    let videoParent = _this.parents(selector.container);
    let currentVideo = videoParent.find("video")[0];

    if (currentVideo)
      // Update video src based on window
      updateVideo(videoParent, currentVideo);

    // Autoplay
    isAutoplaySupported((canAutoplay) => {
      if (_this.attr("autoplay") && canAutoplay) {
        _this.data("played", true);
        _this.css("zIndex", 0);
        removeElementsOnPlay(videoParent, 0);
        videoParent.find("." + classes.playButton).hide();
      }
    });

    // Play button event
    videoOnClick(videoParent.find("." + classes.playButton), videoParent);
  });
};

// page load
flexibleVideo();

$(window).on("resize", () => {
  flexibleVideo();
});

export default flexibleVideo;
