
// https://www.googleapis.com/youtube/v3/playlists?id=PLeq_eMdgfBrO5KhjMoZDMauqGvFoheCCC&key=AIzaSyAzzbv7YNGv7kXAuIPXiqv-TsdioLeVuI0

async function playlist() {
  let result = await fetch(`https://www.googleapis.com/youtube/v3/playlistItems?part=contentDetails,id&playlistId=PLeq_eMdgfBrO5KhjMoZDMauqGvFoheCCC&maxResults=50&key=YOURKEYHERE`);
  let data = await result.json();
  data.items.forEach(video => {
    let videoId = video.contentDetails.videoId;
    let mainVideo = document.createElement("iframe");
    mainVideo.src = `https://www.youtube.com/embed/${videoId}`;
    mainVideo.width = 560;
    mainVideo.height = 315;
    mainVideo.title = "YouTube video player";
    mainVideo.frameborder = 0;
    mainVideo.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share";
    mainVideo.referrerpolicy = "strict-origin-when-cross-origin";
    mainVideo.allowfullscreen = "allowfullscreen";
    document.getElementById("playlist").append(mainVideo);
  });
}
playlist();



/*
<iframe width="560" height="315" src="https://www.youtube.com/embed/Sk2Vr2ve1l8?si=2EAHcKen02erVlfZ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
*/
