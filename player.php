<script>
    let songs = <?php echo $songlist; ?>;
    // console.log(songs);
    // console.log("Welcome to MUZIK");

    // let songIndex = 0;
    let songIndex = Math.floor((Math.random() * songs.length));
    let audio = new Audio(songs[songIndex].filePath);

    let pbtn = document.getElementById('masterPlay');
    let prevbtn = document.getElementById('previous');
    let nextbtn = document.getElementById('next');
    let gif = document.getElementById('gif');

    let progressBar = document.getElementById('progressBar');
    let md = document.getElementById('md');
    let ct = document.getElementById('ct');

    let bar = document.getElementById('bar');
    let masterSongName = document.getElementById('masterSongName');
    let songItems = Array.from(document.getElementsByClassName('songitem'));

    let spbtn = document.querySelectorAll("span.songItemPlay img");

    let loopsong = document.getElementById("loopsong");
    let shufflesong = document.getElementById("shufflesong");


    var songplaying = false;
    var loop = false;
    var songshuffle = false;

    loopsong.addEventListener("click", () => {
        if (songshuffle === true) {
            loop = false;
        } else {
            loop = !loop;
        }

        if (loop === true) {
            loopsong.style.color = "pink";
        } else {
            loopsong.style.color = "";
        }
    });

    shufflesong.addEventListener("click", () => {
        if (loop === true) {
            songshuffle = false;
        } else {
            songshuffle = !songshuffle;
        }

        if (songshuffle === true) {
            shufflesong.style.color = "pink";
        } else {
            shufflesong.style.color = "";
        }
    });


    // For list of available songs...(Nikhil's code)
    songItems.forEach((element, i) => {
        element.getElementsByTagName("img")[0].src = songs[i].coverPath;
        element.getElementsByClassName("songName")[0].innerText = songs[i].songName;
    });

    const loadmusicdata = (idx) => {
        audio.src = songs[idx].filePath;
        // simg.src = songs[idx].img;

        audio.onloadeddata = () => {
            let mins = Math.floor(audio.duration / 60);
            let seconds = Math.floor(audio.duration % 60);
            if (seconds < 10) seconds = `0${seconds}`;
            md.innerHTML = `${mins}:${seconds}`;
            masterSongName.innerText = songs[songIndex].songName;
        }
    }

    loadmusicdata(songIndex);

    function playpause() {
        if (!songplaying) {
            // play
            audio.play();
            masterPlay.children[0].src = './icons/pause_circle.svg';
            document.getElementById(songIndex).src = './icons/bpause.svg';
            document.getElementById(songIndex).setAttribute("status", "playing");
            gif.style.opacity = 1;
        } else {
            // pause
            audio.pause();
            masterPlay.children[0].src = './icons/play_circle.svg';
            document.getElementById(songIndex).src = './icons/bplay.svg';
            document.getElementById(songIndex).setAttribute("status", "paused");
            gif.style.opacity = 0;
        }
        songplaying = !songplaying;
    }


    function nextsong() {
        // document.getElementById(songIndex-1).src = './icons/bplay.svg';
        audio.pause();

        document.getElementById(songIndex).setAttribute("status", "paused");
        document.getElementById(songIndex).src = './icons/bplay.svg';

        if (songIndex < songs.length - 1) {
            songIndex++;
        } else {
            songIndex = 0;
        }

        loadmusicdata(songIndex);
        audio.play();
        gif.style.opacity = 1;
        masterPlay.children[0].src = './icons/pause_circle.svg';
        songplaying = true;

        document.getElementById(songIndex).setAttribute("status", "playing");
        document.getElementById(songIndex).src = './icons/bpause.svg';
    }


    function prevsong() {
        // document.getElementById(songIndex+1).src = './icons/bplay.svg';
        audio.pause();

        document.getElementById(songIndex).setAttribute("status", "paused");
        document.getElementById(songIndex).src = './icons/bplay.svg';

        if (songIndex > 0) {
            songIndex--;
        } else {
            songIndex = songs.length - 1;
        }

        loadmusicdata(songIndex);
        audio.play();
        gif.style.opacity = 1;
        masterPlay.children[0].src = './icons/pause_circle.svg';
        songplaying = true;

        document.getElementById(songIndex).setAttribute("status", "playing");
        document.getElementById(songIndex).src = './icons/bpause.svg';
    }

    function startsong(idx) {
        songIndex = idx;
        loadmusicdata(songIndex);
        audio.play();
        gif.style.opacity = 1;
        masterPlay.children[0].src = './icons/pause_circle.svg';
        songplaying = true;

        document.getElementById(songIndex).setAttribute("status", "playing");
        document.getElementById(songIndex).src = './icons/bpause.svg';
    }

    pbtn.addEventListener("click", playpause);
    nextbtn.addEventListener("click", nextsong);
    prevbtn.addEventListener("click", prevsong);

    spbtn.forEach(s => s.addEventListener("click", () => {
        let mi = s.getAttribute("id");
        let st = s.getAttribute("status");
        playsmall(mi, st);
    }));

    function playsmall(sid, st) {
        // spbtn.forEach(s => s.src = './icons/bplay.svg');
        let si = document.getElementById(`${sid}`);
        // console.log(si);
        // console.log(songIndex,sid);
        // console.log(sid, st);

        /* Used == instead of === coz sid(string) songIndex(int) */
        if (songIndex != sid) {
            document.getElementById(songIndex).setAttribute("status", "paused");
            document.getElementById(songIndex).src = './icons/bplay.svg';

            songIndex = sid;
            loadmusicdata(songIndex);

            si.setAttribute("status", "playing");
            si.src = './icons/bpause.svg';
            gif.style.opacity = 1;

        }

        if (songIndex == sid) {
            // console.log(songIndex, sid);
            if (st === "playing") {
                document.getElementById(songIndex).setAttribute("status", "paused");
                document.getElementById(songIndex).src = './icons/bplay.svg';

                audio.pause();
                songplaying = false;

                masterPlay.children[0].src = './icons/play_circle.svg';
                gif.style.opacity = 0;
            }
            if (st === "paused") {
                // console.log(songIndex, sid);
                document.getElementById(songIndex).setAttribute("status", "playing");
                document.getElementById(songIndex).src = './icons/bpause.svg';

                audio.play();
                songplaying = true;

                masterPlay.children[0].src = './icons/pause_circle.svg';
                gif.style.opacity = 1;

            }
            // console.log('hwuekwfege');
        }

    }

    audio.addEventListener("timeupdate", (e) => {
        let mins = Math.floor(audio.currentTime / 60);
        let seconds = Math.floor(audio.currentTime % 60);
        if (seconds < 10) seconds = `0${seconds}`;

        ct.innerHTML = `${mins}:${seconds}`;
        let progressWidth = (audio.currentTime / audio.duration) * 100;
        progressBar.style.width = `${progressWidth}%`;
    });

    audio.addEventListener("ended", () => {
        if (loop === true) {
            startsong(songIndex);
        } else if (songshuffle === true) {
            document.getElementById(songIndex).setAttribute("status", "paused");
            document.getElementById(songIndex).src = './icons/bplay.svg';
            startsong(Math.floor((Math.random() * songs.length)));
        } else {
            nextsong();
        }
    });
</script>