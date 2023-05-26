<?php

use PHPUnit\Framework\TestCase;

/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Feed
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once 'Zend/Feed/Writer/Feed.php';

/**
 * @category   Zend
 * @package    Zend_Feed
 * @subpackage UnitTests
 * @group      Zend_Feed
 * @group      Zend_Feed_Writer
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Feed_Writer_FeedTest extends TestCase
{
    protected $_feedSamplePath = null;

    protected function setUp(): void
    {
        $this->_feedSamplePath = dirname(__FILE__) . '/Writer/_files';
    }

    public function testAddsAuthorName()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->addAuthor('Joe');
        $this->assertEquals(['name' => 'Joe'], $writer->getAuthor());
    }

    public function testAddsAuthorEmail()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->addAuthor('Joe', 'joe@example.com');
        $this->assertEquals(['name' => 'Joe', 'email' => 'joe@example.com'], $writer->getAuthor());
    }

    public function testAddsAuthorUri()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->addAuthor('Joe', null, 'http://www.example.com');
        $this->assertEquals(['name' => 'Joe', 'uri' => 'http://www.example.com'], $writer->getAuthor());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testAddAuthorThrowsExceptionOnInvalidName()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->addAuthor('');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testAddAuthorThrowsExceptionOnInvalidEmail()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->addAuthor('Joe', '');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testAddAuthorThrowsExceptionOnInvalidUri()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->addAuthor('Joe', null, 'notauri');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    public function testAddsAuthorNameFromArray()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->addAuthor(['name' => 'Joe']);
        $this->assertEquals(['name' => 'Joe'], $writer->getAuthor());
    }

    public function testAddsAuthorEmailFromArray()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->addAuthor(['name' => 'Joe', 'email' => 'joe@example.com']);
        $this->assertEquals(['name' => 'Joe', 'email' => 'joe@example.com'], $writer->getAuthor());
    }

    public function testAddsAuthorUriFromArray()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->addAuthor(['name' => 'Joe', 'uri' => 'http://www.example.com']);
        $this->assertEquals(['name' => 'Joe', 'uri' => 'http://www.example.com'], $writer->getAuthor());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testAddAuthorThrowsExceptionOnInvalidNameFromArray()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->addAuthor(['name' => '']);
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testAddAuthorThrowsExceptionOnInvalidEmailFromArray()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->addAuthor(['name' => 'Joe', 'email' => '']);
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testAddAuthorThrowsExceptionOnInvalidUriFromArray()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->addAuthor(['name' => 'Joe', 'uri' => 'notauri']);
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testAddAuthorThrowsExceptionIfNameOmittedFromArray()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->addAuthor(['uri' => 'notauri']);
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    public function testAddsAuthorsFromArrayOfAuthors()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->addAuthors([
            ['name' => 'Joe', 'uri' => 'http://www.example.com'],
            ['name' => 'Jane', 'uri' => 'http://www.example.com']
        ]);
        $this->assertEquals(['name' => 'Jane', 'uri' => 'http://www.example.com'], $writer->getAuthor(1));
    }

    public function testSetsCopyright()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setCopyright('Copyright (c) 2009 Paddy Brady');
        $this->assertEquals('Copyright (c) 2009 Paddy Brady', $writer->getCopyright());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetCopyrightThrowsExceptionOnInvalidParam()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setCopyright('');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    public function testSetDateCreatedDefaultsToCurrentTime()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setDateCreated();
        $dateNow = new Zend_Date();
        $this->assertTrue($dateNow->isLater($writer->getDateCreated()) || $dateNow->equals($writer->getDateCreated()));
    }

    public function testSetDateCreatedUsesGivenUnixTimestamp()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setDateCreated(1234567890);
        $myDate = new Zend_Date('1234567890', Zend_Date::TIMESTAMP);
        $this->assertTrue($myDate->equals($writer->getDateCreated()));
    }
    
    /**
     * @group ZF-12023
     */
    public function testSetDateCreatedUsesGivenUnixTimestampThatIsLessThanTenDigits()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setDateCreated(123456789);
        $myDate = new Zend_Date('123456789', Zend_Date::TIMESTAMP);
        $this->assertTrue($myDate->equals($writer->getDateCreated()));
    }
    
    /**
     * @group ZF-11610
     */
    public function testSetDateCreatedUsesGivenUnixTimestampThatIsAVerySmallInteger()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setDateCreated(123);
        $myDate = new Zend_Date('123', Zend_Date::TIMESTAMP);
        $this->assertTrue($myDate->equals($writer->getDateCreated()));
    }

    public function testSetDateCreatedUsesZendDateObject()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setDateCreated(new Zend_Date('1234567890', Zend_Date::TIMESTAMP));
        $myDate = new Zend_Date('1234567890', Zend_Date::TIMESTAMP);
        $this->assertTrue($myDate->equals($writer->getDateCreated()));
    }

    public function testSetDateModifiedDefaultsToCurrentTime()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setDateModified();
        $dateNow = new Zend_Date();
        $this->assertTrue($dateNow->isLater($writer->getDateModified()) || $dateNow->equals($writer->getDateModified()));
    }

    public function testSetDateModifiedUsesGivenUnixTimestamp()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setDateModified(1234567890);
        $myDate = new Zend_Date('1234567890', Zend_Date::TIMESTAMP);
        $this->assertTrue($myDate->equals($writer->getDateModified()));
    }

    /**
     * @group ZF-12023
     */
    public function testSetDateModifiedUsesGivenUnixTimestampThatIsLessThanTenDigits()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setDateModified(123456789);
        $myDate = new Zend_Date('123456789', Zend_Date::TIMESTAMP);
        $this->assertTrue($myDate->equals($writer->getDateModified()));
    }

    /**
     * @group ZF-11610
     */
    public function testSetDateModifiedUsesGivenUnixTimestampThatIsAVerySmallInteger()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setDateModified(123);
        $myDate = new Zend_Date('123', Zend_Date::TIMESTAMP);
        $this->assertTrue($myDate->equals($writer->getDateModified()));
    }

    public function testSetDateModifiedUsesZendDateObject()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setDateModified(new Zend_Date('1234567890', Zend_Date::TIMESTAMP));
        $myDate = new Zend_Date('1234567890', Zend_Date::TIMESTAMP);
        $this->assertTrue($myDate->equals($writer->getDateModified()));
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetDateCreatedThrowsExceptionOnInvalidParameter()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setDateCreated('abc');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetDateModifiedThrowsExceptionOnInvalidParameter()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setDateModified('abc');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    public function testGetDateCreatedReturnsNullIfDateNotSet()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $this->assertTrue(is_null($writer->getDateCreated()));
    }

    public function testGetDateModifiedReturnsNullIfDateNotSet()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $this->assertTrue(is_null($writer->getDateModified()));
    }

    public function testSetLastBuildDateDefaultsToCurrentTime()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setLastBuildDate();
        $dateNow = new Zend_Date();
        $this->assertTrue($dateNow->isLater($writer->getLastBuildDate()) || $dateNow->equals($writer->getLastBuildDate()));
    }

    public function testSetLastBuildDateUsesGivenUnixTimestamp()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setLastBuildDate(1234567890);
        $myDate = new Zend_Date('1234567890', Zend_Date::TIMESTAMP);
        $this->assertTrue($myDate->equals($writer->getLastBuildDate()));
    }

    /**
     * @group ZF-12023
     */
    public function testSetLastBuildDateUsesGivenUnixTimestampThatIsLessThanTenDigits()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setLastBuildDate(123456789);
        $myDate = new Zend_Date('123456789', Zend_Date::TIMESTAMP);
        $this->assertTrue($myDate->equals($writer->getLastBuildDate()));
    }

    /**
     * @group ZF-11610
     */
    public function testSetLastBuildDateUsesGivenUnixTimestampThatIsAVerySmallInteger()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setLastBuildDate(123);
        $myDate = new Zend_Date('123', Zend_Date::TIMESTAMP);
        $this->assertTrue($myDate->equals($writer->getLastBuildDate()));
    }

    public function testSetLastBuildDateUsesZendDateObject()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setLastBuildDate(new Zend_Date('1234567890', Zend_Date::TIMESTAMP));
        $myDate = new Zend_Date('1234567890', Zend_Date::TIMESTAMP);
        $this->assertTrue($myDate->equals($writer->getLastBuildDate()));
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetLastBuildDateThrowsExceptionOnInvalidParameter()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setLastBuildDate('abc');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    public function testGetLastBuildDateReturnsNullIfDateNotSet()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $this->assertTrue(is_null($writer->getLastBuildDate()));
    }

    public function testGetCopyrightReturnsNullIfDateNotSet()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $this->assertTrue(is_null($writer->getCopyright()));
    }

    public function testSetsDescription()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setDescription('abc');
        $this->assertEquals('abc', $writer->getDescription());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetDescriptionThrowsExceptionOnInvalidParameter()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setDescription('');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    public function testGetDescriptionReturnsNullIfDateNotSet()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $this->assertTrue(is_null($writer->getDescription()));
    }

    public function testSetsId()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setId('http://www.example.com/id');
        $this->assertEquals('http://www.example.com/id', $writer->getId());
    }

    public function testSetsIdAcceptsUrns()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setId('urn:uuid:60a76c80-d399-11d9-b93C-0003939e0af6');
        $this->assertEquals('urn:uuid:60a76c80-d399-11d9-b93C-0003939e0af6', $writer->getId());
    }

    public function testSetsIdAcceptsSimpleTagUri()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setId('tag:example.org,2010:/foo/bar/');
        $this->assertEquals('tag:example.org,2010:/foo/bar/', $writer->getId());
    }

    public function testSetsIdAcceptsComplexTagUri()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setId('tag:diveintomark.org,2004-05-27:/archives/2004/05/27/howto-atom-linkblog');
        $this->assertEquals('tag:diveintomark.org,2004-05-27:/archives/2004/05/27/howto-atom-linkblog', $writer->getId());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetIdThrowsExceptionOnInvalidParameter()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setId('');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetIdThrowsExceptionOnInvalidUri()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setId('http://');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    public function testGetIdReturnsNullIfDateNotSet()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $this->assertTrue(is_null($writer->getId()));
    }

    public function testSetsLanguage()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setLanguage('abc');
        $this->assertEquals('abc', $writer->getLanguage());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetLanguageThrowsExceptionOnInvalidParameter()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setLanguage('');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    public function testGetLanguageReturnsNullIfDateNotSet()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $this->assertTrue(is_null($writer->getLanguage()));
    }

    public function testSetsLink()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setLink('http://www.example.com/id');
        $this->assertEquals('http://www.example.com/id', $writer->getLink());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetLinkThrowsExceptionOnEmptyString()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setLink('');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetLinkThrowsExceptionOnInvalidUri()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setLink('http://');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    public function testGetLinkReturnsNullIfDateNotSet()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $this->assertTrue(is_null($writer->getLink()));
    }

    public function testSetsEncoding()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setEncoding('utf-16');
        $this->assertEquals('utf-16', $writer->getEncoding());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetEncodingThrowsExceptionOnInvalidParameter()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setEncoding('');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    public function testGetEncodingReturnsUtf8IfNotSet()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $this->assertEquals('UTF-8', $writer->getEncoding());
    }

    public function testSetsTitle()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setTitle('abc');
        $this->assertEquals('abc', $writer->getTitle());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetTitleThrowsExceptionOnInvalidParameter()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setTitle('');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    public function testGetTitleReturnsNullIfDateNotSet()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $this->assertTrue(is_null($writer->getTitle()));
    }

    public function testSetsGeneratorName()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setGenerator(['name' => 'ZFW']);
        $this->assertEquals(['name' => 'ZFW'], $writer->getGenerator());
    }

    public function testSetsGeneratorVersion()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setGenerator(['name' => 'ZFW', 'version' => '1.0']);
        $this->assertEquals(['name' => 'ZFW', 'version' => '1.0'], $writer->getGenerator());
    }

    public function testSetsGeneratorUri()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setGenerator(['name' => 'ZFW', 'uri' => 'http://www.example.com']);
        $this->assertEquals(['name' => 'ZFW', 'uri' => 'http://www.example.com'], $writer->getGenerator());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetsGeneratorThrowsExceptionOnInvalidName()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setGenerator([]);
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetsGeneratorThrowsExceptionOnInvalidVersion()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setGenerator(['name' => 'ZFW', 'version' => '']);
            $this->fail('Should have failed since version is empty');
        } catch (Zend_Feed_Exception $e) {
        }
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetsGeneratorThrowsExceptionOnInvalidUri()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setGenerator(['name' => 'ZFW', 'uri' => 'notauri']);
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    /**
     * @deprecated
     */
    public function testSetsGeneratorName_Deprecated()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setGenerator('ZFW');
        $this->assertEquals(['name' => 'ZFW'], $writer->getGenerator());
    }

    /**
     * @deprecated
     */
    public function testSetsGeneratorVersion_Deprecated()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setGenerator('ZFW', '1.0');
        $this->assertEquals(['name' => 'ZFW', 'version' => '1.0'], $writer->getGenerator());
    }

    /**
     * @deprecated
     */
    public function testSetsGeneratorUri_Deprecated()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setGenerator('ZFW', null, 'http://www.example.com');
        $this->assertEquals(['name' => 'ZFW', 'uri' => 'http://www.example.com'], $writer->getGenerator());
    }

    /**
     * @deprecated
     * @doesNotPerformAssertions
     */
    public function testSetsGeneratorThrowsExceptionOnInvalidName_Deprecated()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setGenerator('');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    /**
     * @deprecated
     * @doesNotPerformAssertions
     */
    public function testSetsGeneratorThrowsExceptionOnInvalidVersion_Deprecated()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setGenerator('ZFW', '');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    /**
     * @deprecated
     * @doesNotPerformAssertions
     */
    public function testSetsGeneratorThrowsExceptionOnInvalidUri_Deprecated()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setGenerator('ZFW', null, 'notauri');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    public function testGetGeneratorReturnsNullIfDateNotSet()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $this->assertTrue(is_null($writer->getGenerator()));
    }

    public function testSetsFeedLink()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setFeedLink('http://www.example.com/rss', 'RSS');
        $this->assertEquals(['rss' => 'http://www.example.com/rss'], $writer->getFeedLinks());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetsFeedLinkThrowsExceptionOnInvalidType()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setFeedLink('http://www.example.com/rss', 'abc');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetsFeedLinkThrowsExceptionOnInvalidUri()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setFeedLink('http://', 'rss');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    public function testGetFeedLinksReturnsNullIfNotSet()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $this->assertTrue(is_null($writer->getFeedLinks()));
    }

    public function testSetsBaseUrl()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setBaseUrl('http://www.example.com');
        $this->assertEquals('http://www.example.com', $writer->getBaseUrl());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetsBaseUrlThrowsExceptionOnInvalidUri()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->setBaseUrl('http://');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    public function testGetBaseUrlReturnsNullIfNotSet()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $this->assertTrue(is_null($writer->getBaseUrl()));
    }

    public function testAddsHubUrl()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->addHub('http://www.example.com/hub');
        $this->assertEquals(['http://www.example.com/hub'], $writer->getHubs());
    }

    public function testAddsManyHubUrls()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->addHubs(['http://www.example.com/hub', 'http://www.example.com/hub2']);
        $this->assertEquals(['http://www.example.com/hub', 'http://www.example.com/hub2'], $writer->getHubs());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testAddingHubUrlThrowsExceptionOnInvalidUri()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->addHub('http://');
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    public function testAddingHubUrlReturnsNullIfNotSet()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $this->assertTrue(is_null($writer->getHubs()));
    }

    public function testCreatesNewEntryDataContainer()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $entry = $writer->createEntry();
        $this->assertTrue($entry instanceof Zend_Feed_Writer_Entry);
    }

    public function testAddsCategory()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->addCategory(['term' => 'cat_dog']);
        $this->assertEquals([['term' => 'cat_dog']], $writer->getCategories());
    }

    public function testAddsManyCategories()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->addCategories([['term' => 'cat_dog'], ['term' => 'cat_mouse']]);
        $this->assertEquals([['term' => 'cat_dog'], ['term' => 'cat_mouse']], $writer->getCategories());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testAddingCategoryWithoutTermThrowsException()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->addCategory(['label' => 'Cats & Dogs', 'scheme' => 'http://www.example.com/schema1']);
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testAddingCategoryWithInvalidUriAsSchemeThrowsException()
    {
        $writer = new Zend_Feed_Writer_Feed();
        try {
            $writer->addCategory(['term' => 'cat_dog', 'scheme' => 'http://']);
            $this->fail();
        } catch (Zend_Feed_Exception $e) {
        }
    }

    // Image Tests

    public function testSetsImageUri()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setImage([
            'uri' => 'http://www.example.com/logo.gif'
        ]);
        $this->assertEquals([
            'uri' => 'http://www.example.com/logo.gif'
        ], $writer->getImage());
    }

    public function testSetsImageUriThrowsExceptionOnEmptyUri()
    {
        $this->expectException(Zend_Feed_Exception::class);
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setImage([
            'uri' => ''
        ]);
    }

    public function testSetsImageUriThrowsExceptionOnMissingUri()
    {
        $this->expectException(Zend_Feed_Exception::class);
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setImage([]);
    }

    public function testSetsImageUriThrowsExceptionOnInvalidUri()
    {
        $this->expectException(Zend_Feed_Exception::class);
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setImage([
            'uri' => 'http://'
        ]);
    }

    public function testSetsImageLink()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setImage([
            'uri' => 'http://www.example.com/logo.gif',
            'link' => 'http://www.example.com'
        ]);
        $this->assertEquals([
            'uri' => 'http://www.example.com/logo.gif',
            'link' => 'http://www.example.com'
        ], $writer->getImage());
    }

    public function testSetsImageTitle()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setImage([
            'uri' => 'http://www.example.com/logo.gif',
            'title' => 'Image title'
        ]);
        $this->assertEquals([
            'uri' => 'http://www.example.com/logo.gif',
            'title' => 'Image title'
        ], $writer->getImage());
    }

    public function testSetsImageHeight()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setImage([
            'uri' => 'http://www.example.com/logo.gif',
            'height' => '88'
        ]);
        $this->assertEquals([
            'uri' => 'http://www.example.com/logo.gif',
            'height' => '88'
        ], $writer->getImage());
    }

    public function testSetsImageWidth()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setImage([
            'uri' => 'http://www.example.com/logo.gif',
            'width' => '88'
        ]);
        $this->assertEquals([
            'uri' => 'http://www.example.com/logo.gif',
            'width' => '88'
        ], $writer->getImage());
    }

    public function testSetsImageDescription()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setImage([
            'uri' => 'http://www.example.com/logo.gif',
            'description' => 'Image description'
        ]);
        $this->assertEquals([
            'uri' => 'http://www.example.com/logo.gif',
            'description' => 'Image description'
        ], $writer->getImage());
    }

    // Icon Tests

    public function testSetsIconUri()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setIcon([
            'uri' => 'http://www.example.com/logo.gif'
        ]);
        $this->assertEquals([
            'uri' => 'http://www.example.com/logo.gif'
        ], $writer->getIcon());
    }

    public function testSetsIconUriThrowsExceptionOnEmptyUri()
    {
        $this->expectException(Zend_Feed_Exception::class);
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setIcon([
            'uri' => ''
        ]);
    }

    public function testSetsIconUriThrowsExceptionOnMissingUri()
    {
        $this->expectException(Zend_Feed_Exception::class);
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setIcon([]);
    }

    public function testSetsIconUriThrowsExceptionOnInvalidUri()
    {
        $this->expectException(Zend_Feed_Exception::class);
        $writer = new Zend_Feed_Writer_Feed();
        $writer->setIcon([
            'uri' => 'http://'
        ]);
    }

    public function testGetCategoriesReturnsNullIfNotSet()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $this->assertTrue(is_null($writer->getCategories()));
    }

    public function testAddsAndOrdersEntriesByDateIfRequested()
    {
        $writer = new Zend_Feed_Writer_Feed();
        $entry = $writer->createEntry();
        $entry->setDateCreated(1234567890);
        $entry2 = $writer->createEntry();
        $entry2->setDateCreated(1230000000);
        $writer->addEntry($entry);
        $writer->addEntry($entry2);
        $writer->orderByDate();
        $this->assertEquals(1230000000, $writer->getEntry(1)->getDateCreated()->get(Zend_Date::TIMESTAMP));
    }
}
