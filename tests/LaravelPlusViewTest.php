<?php

namespace Wuwx\LaravelPlusView\Test;

class LaravelPlusViewTest extends TestCase
{
    public function testHtml()
    {
        $this->get("/")->assertSee("html");
        $this->get("/?_format=html")->assertSee("html");
    }

    public function testJs()
    {
        $this->get("/?_format=js")->assertSee("js");
    }

    public function testJson()
    {
        $this->get("/?_format=json")->assertSee("json");
    }

    public function testXml()
    {
        $this->get("/?_format=xml")->assertSee("xml");
    }
}