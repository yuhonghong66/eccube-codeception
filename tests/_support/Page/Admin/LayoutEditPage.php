<?php


namespace Page\Admin;


class LayoutEditPage extends AbstractAdminPageStyleGuide
{

    public static $登録完了メッセージ = '#page_admin_content_layout_edit > div.c-container > div.c-contentsArea > div.alert.alert-success.alert-dismissible.fade.show.m-3 > span';

    /**
     * LayoutEditPage constructor.
     */
    public function __construct(\AcceptanceTester $I)
    {
        parent::__construct($I);
    }

    public static function at($I)
    {
        $page = new self($I);
        return $page->atPage('レイアウト管理コンテンツ管理');
    }

    public function 登録()
    {
        $this->tester->waitForElementVisible('#form1 > div > div.c-conversionArea > div > div > div:nth-child(2) > div > div > button');
        $this->tester->click('#form1 > div > div.c-conversionArea > div > div > div:nth-child(2) > div > div > button');
        return $this;
    }

    public function ブロックを移動($blockName, $dest, $timeout = 10)
    {
        if (strlen($blockName) > 10) {
            $blockName = mb_strimwidth($blockName, 0, 11, '…');
        }
        $this->tester->waitForElementVisible(['xpath' => "//div[contains(@id, 'detail_box__layout_item')][div[div[1][a[text()='${blockName}']]]]"], $timeout);
        $this->tester->dragAndDrop(['xpath' => "//div[contains(@id, 'detail_box__layout_item')][div[div[1][a[text()='${blockName}']]]]"], $dest);
        return $this;
    }

    public function コンテキストメニューを開く($blockName)
    {
        $this->tester->click(['xpath' => "//div[contains(@id, 'detail_box__layout_item')][div[div[1][a[text()='${blockName}']]]]/div/div[2]"]);
        return $this;
    }

    public function コンテキストメニューで上に移動($blockName)
    {
        $this->コンテキストメニューを開く($blockName);
        $this->tester->waitForElementVisible(['xpath' => "//div[contains(@id, 'popover')]/div[2]/div/a[1]"]);
        $this->tester->click(['xpath' => "//div[contains(@id, 'popover')]/div[2]/div/a[1]"]);
        return $this;
    }

    public function コンテキストメニューで下に移動($blockName)
    {
        $this->コンテキストメニューを開く($blockName);
        $this->tester->waitForElementVisible(['xpath' => "//div[contains(@id, 'popover')]/div[2]/div/a[2]"]);
        $this->tester->click(['xpath' => "//div[contains(@id, 'popover')]/div[2]/div/a[2]"]);
        return $this;
    }

    public function コンテキストメニューでセクションに移動($blockName)
    {
        $this->コンテキストメニューを開く($blockName);
        $this->tester->waitForElementVisible(['xpath' => "//div[contains(@id, 'popover')]/div[2]/div/a[3]"]);
        $this->tester->click(['xpath' => "//div[contains(@id, 'popover')]/div[2]/div/a[3]"]);
        $this->tester->waitForElementVisible(['id' => "move-to-section"]);
        $this->tester->click(['id' => "move-to-section"]);
        return $this;
    }

    public function コンテキストメニューでコードプレビュー($blockName, $element = null, $timeout = 10)
    {
        $this->コンテキストメニューを開く($blockName);
        $this->tester->waitForElementVisible(['xpath' => "//div[contains(@id, 'popover')]/div[2]/div/a[4]"]);
        $this->tester->click(['xpath' => "//div[contains(@id, 'popover')]/div[2]/div/a[4]"]);
        $this->tester->waitForElementVisible(['id' => "codePreview"]);
        if ($element) {
            $this->tester->waitForElementVisible($element, $timeout);
        }
        $this->tester->click(['xpath' => "//*[@id='codePreview']/div/div/div[3]/button[1]"]);
        return $this;
    }

    public function プレビュー()
    {
        $this->tester->click("#preview_box__preview_button > button");
        return $this;
    }
}
