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
            <?php if(isset($_GET['articleLimit'])) : ?>
                <li class="page-item <?php disable_prev(($page - 1)) ?>">
                    <a class="page-link" href="?page=<?php echo($page - 1); ?>&articleLimit=<?php echo($article_limit);?>" tabindex="-1">Previous</a>
                </li>
                <?php for($i = 0; $i < $total_pages; $i++) : ?>
                    <li class="page-item <?php set_active($page, $i); ?>"><a class="page-link" href="?page=<?php echo($i + 1); ?>&articleLimit=<?php echo($article_limit);?>"><?php echo($i + 1); ?></a></li>
                <?php endfor; ?>
                <li class="page-item <?php disable_next($page); ?>">
                    <a class="page-link" href="?page=<?php echo($page + 1); ?>&articleLimit=<?php echo($article_limit);?>">Next</a>
                </li>
            <?php elseif(isset($_GET['searchInput'])) : ?>
                <li class="page-item <?php disable_prev(($page - 1)) ?>">
                    <a class="page-link" href="?page=<?php echo($page - 1); ?>&searchInput=<?php echo($searchInput);?>" tabindex="-1">Previous</a>
                </li>
                <?php for($i = 0; $i < $total_pages; $i++) : ?>
                    <li class="page-item <?php set_active($page, $i); ?>"><a class="page-link" href="?page=<?php echo($i + 1); ?>&searchInput=<?php echo($searchInput);?>"><?php echo($i + 1); ?></a></li>
                <?php endfor; ?>
                <li class="page-item <?php disable_next($page); ?>">
                    <a class="page-link" href="?page=<?php echo($page + 1); ?>&searchInput=<?php echo($searchInput);?>">Next</a>
                </li>
            <?php else : ?>
                <li class="page-item <?php disable_prev(($page - 1)) ?>">
                    <a class="page-link" href="?page=<?php echo($page - 1); ?>" tabindex="-1">Previous</a>
                </li>
                <?php for($i = 0; $i < $total_pages; $i++) : ?>
                    <li class="page-item <?php set_active($page, $i); ?>"><a class="page-link" href="?page=<?php echo($i + 1); ?>"><?php echo($i + 1); ?></a></li>
                <?php endfor; ?>
                <li class="page-item <?php disable_next($page); ?>">
                    <a class="page-link" href="?page=<?php echo($page + 1); ?>">Next</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>