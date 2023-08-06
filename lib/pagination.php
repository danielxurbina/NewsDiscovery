<?php 
    function persistQueryString($page){
        $_GET["page"] = $page;
        return http_build_query($_GET);
    }

    function disable_prev($page){
        echo $page < 1 ? "disabled" : "";
    }

    function set_active($page, $i){
        echo ($page - 1) == $i ? "active" : "";
    }

    function disable_next($page){
        global $total_pages;
        echo ($page) >= $total_pages ? "disabled" : "";
    }
?>

<div class="row">
    <nav aria-label="page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php disable_prev(($page - 1)) ?>">
                <a class="page-link" href="?<?php se(persistQueryString($page - 1)); ?>" tabindex="-1">Previous</a>
            </li>
            <?php for ($i = 0; $i < $total_pages; $i++) : ?>
                <li class="page-item <?php set_active($page, $i); ?>"><a class="page-link" href="?<?php se(persistQueryString($i + 1)); ?>"><?php echo ($i + 1); ?></a></li>
            <?php endfor; ?>
            <li class="page-item <?php disable_next($page); ?>">
                <a class="page-link" href="?<?php se(persistQueryString($page + 1)); ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>