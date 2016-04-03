<?php
namespace Craft;
class ReadTimePlugin extends BasePlugin
{   
    protected $_version = '1.0.0',
      $_schemaVersion = '1.0.0',
      $_name = 'Read Time',
      $_url = 'https://github.com/zizther/craft_readtime',
      $_releaseFeedUrl = 'https://raw.githubusercontent.com/zizther/craft_readtime/master/releases.json',
      $_documentationUrl = 'https://github.com/zizther/craft_readtime/blob/master/README.md',
      $_description = 'An estimated read time Twig filter for Craft CMS.',
      $_developer = 'Nathan Reed',
      $_developerUrl = 'http://vimia.co.uk/',
      $_minVersion = '2.0';
    
    public function getName()
    {
        return Craft::t($this->_name);
    }
    public function getUrl()
    {
        return $this->_url;
    }
    public function getVersion()
    {
        return $this->_version;
    }
    public function getDeveloper()
    {
        return $this->_developer;
    }
    public function getDeveloperUrl()
    {
        return $this->_developerUrl;
    }
    public function getDescription()
    {
        return $this->_description;
    }
    public function getDocumentationUrl()
    {
        return $this->_documentationUrl;
    }
    public function getSchemaVersion()
    {
        return $this->_schemaVersion;
    }
    public function getReleaseFeedUrl()
    {
        return $this->_releaseFeedUrl;
    }
    public function getCraftRequiredVersion()
    {
        return $this->_minVersion;
    }
    
    
    // Twig Extension
    public function addTwigExtension()  
    {
        Craft::import('plugins.readtime.twigextensions.ReadTimeTwigExtension');
    
        return new ReadTimeTwigExtension();
    }
}