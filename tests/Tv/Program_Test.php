<?php
use XMLTV\Xmltv;
use XMLTV\XmltvElement;
use XMLTV\Tv\Programme;

class Programme_Test extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $xmltv = new Xmltv();
        $xmltv->addProgramme(function (&$programme) {
            $this->element = $programme;
        });
    }

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

        $program = new Programme($attributes);
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
            ->addLength(['units' => 'minutes'], 120)
            ->addIcon(['src' => 'https://b-alidra.com/icon.png'])
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
            //->add_new([], '')
            ->addSubtitles([], function (&$subtitles) {
                $subtitles->addLanguage([], 'English');
            })
            ->addRating([], function (&$rating) {
                $rating
                    ->addValue([], '1/5')
                    ->addIcon(['src' => 'https://b-alidra.com/icon.png']);
            })
            ->addStarrating([], function (&$starrating) {
                $starrating
                    ->addValue([], '1/5')
                    ->addIcon(['src' => 'https://b-alidra.com/icon.png']);
            })
            ->addReview([
                'type'     => 'text',
                'source'   => 'Web',
                'reviewer' => 'Belkacem Alidra',
                'lang'     => 'fr'
            ]);

        $expected_xml = <<<EOF
<programme channel="test-channel" start="20161223184000" stop="20161223194000" pdc-start="20161223184000" vps-start="20161223184000" showview="???" videoplus="???" clumpidx="1">
  <title lang="fr">Chaine de test</title>
  <title lang="en">Test channel</title>
  <sub-title lang="fr">Second tilre de la chaine de test</sub-title>
  <sub-title lang="en">Test channel second title</sub-title>
  <desc lang="fr">Description de la chaine de test</desc>
  <desc lang="en">Test channel description</desc>
  <credits>
    <director>Test director</director>
    <actor>Test actor</actor>
    <writer>Test writer</writer>
    <adapter>Test adapter</adapter>
    <producer>Test producer</producer>
    <composer>Test composer</composer>
    <editor>Test editor</editor>
    <presenter>Test presenter</presenter>
    <commentator>Test commentator</commentator>
    <guest>Test guest</guest>
  </credits>
  <date>20160615</date>
  <category lang="fr">Horreur</category>
  <category lang="en">Horror</category>
  <keyword lang="fr">Fantastique</keyword>
  <keyword lang="en">Fantastic</keyword>
  <language>fr</language>
  <orig-language>en</orig-language>
  <length units="minutes">120</length>
  <icon src="https://b-alidra.com/icon.png"/>
  <url>https://b-alidra.com</url>
  <country>GB</country>
  <episode-num>0.0.0/1</episode-num>
  <video>
    <present>yes</present>
    <colour/>
    <aspect/>
    <quality/>
  </video>
  <audio>
    <present>yes</present>
  </audio>
  <previously-shown/>
  <premiere/>
  <last-chance/>
  <subtitles>
    <language>English</language>
  </subtitles>
  <rating>
    <value>1/5</value>
    <icon src="https://b-alidra.com/icon.png"/>
  </rating>
  <star-rating>
    <value>1/5</value>
    <icon src="https://b-alidra.com/icon.png"/>
  </star-rating>
  <review type="text" source="Web" reviewer="Belkacem Alidra" lang="fr"/>
</programme>
EOF;

        $this->assertEquals($expected_xml, $program->toXml());
    }
}
