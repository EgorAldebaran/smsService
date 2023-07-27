class VideoPlayer
{
    play() {
        console.log ('play from VideoPlayer')
    }

    pause() {
        console.log ('pause from videoplayer')
    }

    stop() {
        console.log ('stop from videoplayer')
    }
}

class AudioPlayer
{
    play() {
        console.log ('play from AudioPlayer')
    }

    pause() {
        console.log ('pause from audioplayer')
    }

    stop() {
        console.log ('stop from audioplayer')
    }
}


class MediaPlayerFacade
{
    contructor() {
        this.videoPlayer = new VideoPlayer;
        this.audioPlayer = new AudioPlayer;
    }

    playVideo() {
        this.VideoPlayer.play()
    }

    pauseVideo() {
	this.videoPlayer.pause()
    }

    stopVideo() {
	this.videoPlayer.stop()
    }

    playAudio() {
	this.audioplayer.play()
    }

        pauseAudio() {
        this.audioPlayer.pause();
    }

    stopAudio() {
        this.audioPlayer.stop();
    }
}

console.log ('---facade ----')
