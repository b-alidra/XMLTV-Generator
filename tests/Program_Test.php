<?php
use XMLTV\Xmltv;
use XMLTV\XmltvElement;
use XMLTV\Program;

class Program_Test extends PHPUnit_Framework_TestCase {

    public function testOutput()
    {
        $attributes = [
            'channel'          => 'test-channel',
            'start'            => '20161223184000',
            'stop'             => '20161223194000',
            'pdc-start'        => '20161223184000',
            'vps-start'        => '20161223184000',
            'showview'         => '???',
            'videoplus'        => '???',
            'clumpidx'         => '1'
        ];

        $expected_xml = <<<EOF
<programme channel="test-channel" start="20161223184000" stop="20161223194000" pdc-start="20161223184000" vps-start="20161223184000" showview="???" videoplus="???" clumpidx="1">
  <title lang="fr">Chaine de test</title>
  <title lang="en">Test channel</title>
  <sub-title lang="fr">Second tilre de la chaine de test</sub-title>
  <sub-title lang="en">Test channel second title</sub-title>
  <desc lang="fr">Description de la chaine de test</desc>
  <desc lang="en">Test channel description</desc>
  <credits>
    <actor>Test actor</actor>
    <adapter>Test adapter</adapter>
    <commentator>Test commentator</commentator>
    <composer>Test composer</composer>
    <director>Test director</director>
    <editor>Test editor</editor>
    <guest>Test guest</guest>
    <presenter>Test presenter</presenter>
    <producer>Test producer</producer>
    <writer>Test writer</writer>
  </credits>
  <date>20160615</date>
  <category lang="fr">Horreur</category>
  <category lang="en">Horror</category>
  <keyword lang="fr">Fantastique</keyword>
  <keyword lang="en">Fantastic</keyword>
  <language>fr</language>
  <orig-language>en</orig-language>
  <length>120</length>
  <icon>https://b-alidra.com/icon.png</icon>
  <url>https://b-alidra.com</url>
  <country>GB</country>
  <episode-num>0.0.0/1</episode-num>
  <video>
    <aspect/>
    <colour/>
    <present>yes</present>
    <quality/>
  </video>
  <audio>
    <present>yes</present>
  </audio>
  <previously-shown/>
  <premiere/>
  <last-chance/>
  <new/>
  <subtitles>
    <language>English</language>
  </subtitles>
  <rating>
    <icon>https://b-alidra.com/icon.png</icon>
  </rating>
  <star-rating>
    <icon>https://b-alidra.com/icon.png</icon>
  </star-rating>
  <review/>
</programme>
EOF;
        $program = new Program($attributes);
        $program
            ->addTitle(['lang' => 'fr'], 'Chaine de test')
            ->addTitle(['lang' => 'en'], 'Test channel')
            ->addSubtitle(['lang' => 'fr'], 'Second tilre de la chaine de test')
            ->addSubtitle(['lang' => 'en'], 'Test channel second title')
            ->addDesc(['lang' => 'fr'], 'Description de la chaine de test')
            ->addDesc(['lang' => 'en'], 'Test channel description')
            ->addCredits([], function (&$credits) {
                $credits
                    ->addActor([], 'Test actor')
                    ->addAdapter([], 'Test adapter')
                    ->addCommentator([], 'Test commentator')
                    ->addComposer([], 'Test composer')
                    ->addDirector([], 'Test director')
                    ->addEditor([], 'Test editor')
                    ->addGuest([], 'Test guest')
                    ->addPresenter([], 'Test presenter')
                    ->addProducer([], 'Test producer')
                    ->addWriter([], 'Test writer');
            })
            ->addDate([], '20160615')
            ->addCategory(['lang' => 'fr'], 'Horreur')
            ->addCategory(['lang' => 'en'], 'Horror')
            ->addKeyword(['lang' => 'fr'], 'Fantastique')
            ->addKeyword(['lang' => 'en'], 'Fantastic')
            ->addLanguage([], 'fr')
            ->addOriglanguage([], 'en')
            ->addLength([], 120)
            ->addIcon([], 'https://b-alidra.com/icon.png')
            ->addUrl([], 'https://b-alidra.com')
            ->addCountry([], 'GB')
            ->addEpisodenum([], '0.0.0/1')
            ->addVideo([], function (&$video) {
                $video
                    ->addAspect([], '')
                    ->addColour([], '')
                    ->addPresent([], 'yes')
                    ->addQuality([], '');
            })
            ->addAudio([], function (&$audio) {
                $audio->addPresent([], 'yes');
            })
            ->addPreviouslyshown([])
            ->addPremiere([], '')
            ->addLastchance([], '')
            ->add_new([], '')
            ->addSubtitles([], function (&$subtitles) {
                $subtitles->addLanguage([], 'English');
            })
            ->addRating([], function (&$rating) {
                $rating->addIcon([], 'https://b-alidra.com/icon.png');
            })
            ->addStarrating([], function (&$starrating) {
                $starrating->addIcon([], 'https://b-alidra.com/icon.png');
            })
            ->addReview([]);

        $this->assertEquals($expected_xml, (string)XmltvElement::getDocument()->saveXml($program->getXml()));
    }
}
