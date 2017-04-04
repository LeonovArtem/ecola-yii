<style>
    .menu {
        display: flex;
    }

    .menu__item {
        padding: 20px;
        text-align: center;
        background-color: orange;
        color: white;
        position: relative;
        flex-grow: 1;
    }

    .menu__item + .menu__item {
        margin-left: 60px;
    }

    .menu__item:before,
    .menu__item:after {
        position: absolute;
        content: "";
        top: 0;
        background-color: orange;
        height: 100%;
        width: 50px;
        z-index: -1;
    }

    .menu__item:before {
        left: -50px;
    }

    .menu__item:nth-child(odd):before {
        transform: skewX(-30deg) translateX(50%);
    }

    .menu__item:nth-child(even):before {
        transform: skewX(30deg) translateX(50%);
    }

    /* Прячем первый псеводоэлемент */
    .menu__item:first-child:before {
        display: none;
    }

    .menu__item:after {
        right: 0;
    }

    .menu__item:nth-child(odd):after {
        transform: skewX(30deg) translateX(50%);
    }

    .menu__item:nth-child(even):after {
        transform: skewX(-30deg) translateX(50%);
    }

    /* Прячем последний псеводоэлемент */
    .menu__item:last-child:after {
        display: none;
    }


</style>
<div class="menu">
    <div class="menu__item">
        Link
    </div>
    <div class="menu__item">
        Link
    </div>
    <div class="menu__item">
        Link
    </div>
    <div class="menu__item">
        Link
    </div>
</div>