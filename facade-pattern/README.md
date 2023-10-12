# Facade Pattern

The Facade design pattern simplifies the interface to a complex system; because it is usually composed of all the classes which make up the subsystems of the complex system.

## Example

```php

<?php 
namespace DesignPattern\Facade\Example;

/**
 * Download video
 * 
 * @package     DesignPattern
 * @subpackage  Facade
 * @author      Mohiuddin Abdul Kader <muhin.cse.diu@gmail.com>
 */
class YouTubeDownloader
{
    /**
     * @var $youtube
     */
    protected $youtube;

    /**
     * @var $ffmpeg
     */
    protected $ffmpeg;

    /**
     * It is handy when the Facade can manage the lifecycle of the subsystem it
     * uses.
     * 
     * @param string $youtubeApiKey
     * @return void
     */
    public function __construct(string $youtubeApiKey)
    {
        $this->youtube = new YouTube($youtubeApiKey);
        $this->ffmpeg = new FFMpeg();
    }

    /**
     * The Facade provides a simple method for downloading video and encoding it
     * to a target format (for the sake of simplicity, the real-world code is
     * commented-out).
     * 
     * @param string $url
     * @return void
     */
    public function downloadVideo(string $url): void
    {
        echo "Fetching video metadata from youtube...\n";
        // $title = $this->youtube->fetchVideo($url)->getTitle();
        echo "Saving video file to a temporary file...\n";
        // $this->youtube->saveAs($url, "video.mpg");

        echo "Processing source video...\n";
        // $video = $this->ffmpeg->open('video.mpg');
        echo "Normalizing and resizing the video to smaller dimensions...\n";
        // $video
        //     ->filters()
        //     ->resize(new FFMpeg\Coordinate\Dimension(320, 240))
        //     ->synchronize();
        echo "Capturing preview image...\n";
        // $video
        //     ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))
        //     ->save($title . 'frame.jpg');
        echo "Saving video in target formats...\n";
        // $video
        //     ->save(new FFMpeg\Format\Video\X264(), $title . '.mp4')
        //     ->save(new FFMpeg\Format\Video\WMV(), $title . '.wmv')
        //     ->save(new FFMpeg\Format\Video\WebM(), $title . '.webm');
        echo "Done!\n";
    }
}

/**
 * The YouTube API subsystem.
 * 
 * @package     DesignPattern
 * @subpackage  Decorator
 * @author      Mohiuddin Abdul Kader <muhin.cse.diu@gmail.com>
 */
class YouTube
{
    
    /**
     * Fetch video
     * 
     * @param none
     * @return string
     */
    public function fetchVideo(): string 
    { 

    }

    /**
     * Save video
     * 
     * @param string $path
     * @return void
     */
    public function saveAs(string $path): void {

    }

}

/**
 * The FFmpeg subsystem (a complex video/audio conversion library).
 * 
 * @package     DesignPattern
 * @subpackage  Facade
 * @author      Mohiuddin Abdul Kader <muhin.cse.diu@gmail.com>
 */
class FFMpeg
{

    /**
     * Create video
     * 
     * @param none
     * @return object
     */
    public static function create(): FFMpeg 
    { 

    }

    /**
     * Open video
     * 
     * @param string $video
     * @return void
     */
    public function open(string $video): void 
    {

    }

}

/**
 * Generate FFMpegVideo
 * 
 * @package     DesignPattern
 * @subpackage  Facade
 * @author      Mohiuddin Abdul Kader <muhin.cse.diu@gmail.com>
 */
class FFMpegVideo
{

    /**
     * Filters video
     * 
     * @return void
     */
    public function filters(): self 
    {

    }

    /**
     * Resize video
     * 
     * @return void
     */
    public function resize(): self 
    {

    }

    /**
     * Synchronize
     * 
     * @return void
     */
    public function synchronize(): self 
    {

    }

    /**
     * Operate frame
     * 
     * @return void
     */
    public function frame(): self 
    {

    }

    /**
     * Save video
     * 
     * @param string $path
     * @return void
     */
    public function save(string $path): self 
    {
        
    }

}

/**
 * The client code does not depend on any subsystem's classes. Any changes
 * inside the subsystem's code won't affect the client code. You will only need
 * to update the Facade.
 */
function clientCode(YouTubeDownloader $facade)
{
    // ...

    $facade->downloadVideo("https://www.youtube.com/watch?v=QH2-TGUlwu4");

    // ...
}

$facade = new YouTubeDownloader("APIKEY-XXXXXXXXX");
clientCode($facade);

```