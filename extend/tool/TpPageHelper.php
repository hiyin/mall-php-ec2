<?php
namespace tool;

use think\Paginator;

class TpPageHelper extends Paginator
{

    //TODO : 中间按钮个数
    protected $bnumber = 10;

    //TODO : 首页
    protected function getfirstButton($str = '')
    {
        if ($this->currentPage() <= 1) {
            return $this->getDisabledTextWrapper($str);
        }

        $url = $this->url(1);

        return $this->getPageLinkWrapper($url, $str);
    }

    //TODO : 上一页
    protected function getPreviousButton($text = "&laquo;")
    {

        if ($this->currentPage() <= 1) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->url(
            $this->currentPage() - 1
        );

        return $this->getPageLinkWrapper($url, $text);
    }

    //TODO : 页码
    protected function getLinks()
    {
        if ($this->total > $this->listRows) {
            if ($this->lastPage < $this->bnumber) {
                return $this->getUrlLinks($this->getUrlRange(1, $this->lastPage));
            } else {
                $min = 1;
                if ($this->currentPage > $this->bnumber / 2) $min = $this->currentPage - floor($this->bnumber / 2);
                if ($this->lastPage - $this->currentPage < $this->bnumber / 2) $min = $this->lastPage - $this->bnumber + 1;
                return $this->getUrlLinks($this->getUrlRange($min, $min + $this->bnumber - 1));
            }
        }
    }

    //TODO : 下一页
    protected function getNextButton($text = '&raquo;')
    {
        if (!$this->hasMore) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->url($this->currentPage() + 1);

        return $this->getPageLinkWrapper($url, $text);
    }

    //TODO : 末页
    protected function getlastButton($text = '')
    {
        if (!$this->hasMore) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->url($this->lastPage());

        return $this->getPageLinkWrapper($url, $text);
    }

    //TODO : 渲染页
    public function render()
    {
        //数据是否足够分页
        if ($this->hasPages()) {
            return sprintf(
                '<ul class="btn-item fr">%s %s %s %s %s</ul>',
                $this->getfirstButton('首页'),
                $this->getPreviousButton('上一页'),
                $this->getLinks(),
                $this->getNextButton('下一页'),
                $this->getlastButton('末页')
            );
        }
    }

    //TODO : 生成禁用按钮
    protected function getDisabledTextWrapper($text)
    {
        return '<li class="disabled"><span>' . $text . '</span></li>';
    }

    //TODO : 生成普通按钮
    protected function getPageLinkWrapper($url, $page)
    {
        if ($page == $this->currentPage()) {
            return $this->getActivePageWrapper($page);
        }

        return $this->getAvailablePageWrapper($url, $page);
    }

    //TODO : 生成当前页按钮
    protected function getActivePageWrapper($text)
    {
        return '<li class="active"><span>' . $text . '</span></li>';
    }

    //TODO : 可点击按钮
    protected function getAvailablePageWrapper($url, $page)
    {
        return '<li><a href="' . htmlentities($url) . '">' . $page . '</a></li>';
    }

    //TODO : 批量生成页码按钮
    protected function getUrlLinks(array $urls)
    {
        $html = '';

        foreach ($urls as $page => $url) {
            $html .= $this->getPageLinkWrapper($url, $page);
        }

        return $html;
    }

}