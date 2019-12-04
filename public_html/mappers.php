<?php

function mapLinktoHTML($link)
{
    $class = "'list-group-item list-group-item-action'";
    $href = urldecode($link['url']);
    $title = $link['title'];
    
    return "<a class=$class href=$href>$title</a>";
}

function mapCategoryToHTML($category)
{
    $name = $category['name'];
    $href = "/?name=" . urlencode($name);

    global $selectedName;

    $class = "'list-group-item list-group-item-action'";
    if (isset($selectedName)) {
        if ($name === $selectedName) {
            $class = "'list-group-item list-group-item-action active'";
        }
    }

    return "<a class=$class href=$href>$name</a>";
}

function mapCategoryToSelectOption($category)
{
    $name = $category['name'];

    $value = urlencode($name);

    return "<option value=$value>$name</option>";
}