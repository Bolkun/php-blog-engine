<?php
/**
 * @goal   autoload all css files from core and custom dirs
 * @param
 * @result html     @example <link rel="stylesheet" href="http://localhost/bolkun/public/core/css/1.bootstrap.css">
 */
function autoload_stylesheet()
{
    // core css files
    $aStyles = getAllFilesInDir(PUBLIC_CORE_CSSROOT);
    foreach ($aStyles as $file) {
        if (preg_match("/^.*\.css$/", $file)) {
            echo '<link rel="stylesheet" href="' . PUBLIC_CORE_CSSURL . '/' . $file . '">' . "\n    ";
        }
    }
    unset($aStyles);
}

/**
 * @goal   autoload all js files from core and custom dirs
 * @param
 * @result html     @example <script src="http://localhost/bolkun/core/js/1.jquery-3.4.1.min.js"></script>
 */
function autoload_javascript()
{
    // core js files
    $aJs = getAllFilesInDir(PUBLIC_CORE_JSROOT);
    foreach ($aJs as $file) {
        if (preg_match("/^.*\.js$/", $file)) {
            echo '<script src="' . PUBLIC_CORE_JSURL . '/' . $file . '"></script>' . "\n";
        }
    }
    unset($aJs);
}

/**
 * @goal   get real ip address from a visitor, when they are also using a proxy
 * @result string
 */
function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}

/**
 * @goal   convert array of objects to array of arrays
 * @param  array of objects $array
 * @return array of arrays
 */
function stdToArray($array)
{
    $reaged = (array)$array;
    foreach ($reaged as $key => &$field) {
        if (is_object($field)) $field = stdToArray($field);
    }
    return $reaged;
}

/**
 * @goal   create dynamic tree view
 * @param  int $parent , array (prepared) $menu
 * @return string html
 */
function createTreeView($parent, $menu)
{
    $html = "";
    if (isset($menu['parents'][$parent])) {
        $html .= "<ol class='tree'>";
        foreach ($menu['parents'][$parent] as $itemId) {
            // check permission color
            if (isset($_SESSION['user_role'])) {
                if (isset($menu['items'][$itemId]['observe_permissions'])) {
                    if ($menu['items'][$itemId]['observe_permissions'] === $_SESSION['user_email']) {
                        $permission_color = '#ff7f50';
                    } else if ($menu['items'][$itemId]['observe_permissions'] === 'Admins') {
                        $permission_color = '#f1f227';
                    } else if ($menu['items'][$itemId]['observe_permissions'] === 'RegisteredUsers') {
                        $permission_color = '#98fb98';
                    } else {
                        $permission_color = 'white';
                    }
                } else {
                    $permission_color = 'white';
                }
            }

            if (!isset($menu['parents'][$itemId])) {
                // node with no children
                if (isAdminLoggedIn()) {
                    $html .= "<li><label for='subfolder2'>
                    <i style='color: grey;' id='mmAddChild" . $menu['items'][$itemId]['blog_id'] . "' onclick='mmAddChild(" . jsonEncodeMenu(NULL, $menu['items'][$itemId]['blog_id'], $menu['items'][$itemId]['title']) . ")' class='fa fa-plus mm_add_child_icon' aria-hidden='true'></i>
                    <i style='color: grey;' id='mmEditTitle" . $menu['items'][$itemId]['blog_id'] . "' onclick='mmEditTitle(" . jsonEncodeMenu(NULL, $menu['items'][$itemId]['blog_id'], $menu['items'][$itemId]['title']) . ")' class='fa fa-pencil mm_edit_title_icon' aria-hidden='true'></i>
                    <a class='main_menu_link' style='color: " . $permission_color . ";' href='" . URLROOT . '/index/' . $menu['items'][$itemId]['blog_id'] . "'>" . $menu['items'][$itemId]['title'] . "</a>
                    <i style='color: grey;' id='mmDeleteBranch" . $menu['items'][$itemId]['blog_id'] . "' onclick='mmDeleteBranch(" . jsonEncodeMenu(NULL, $menu['items'][$itemId]['blog_id'], $menu['items'][$itemId]['title']) . ")' class='fa fa-times mm_delete_branch_icon' aria-hidden='true'></i>
                    </label>
                    <input class='main_menu_checkbox' type='checkbox' name='subfolder2'/></li>";
                } else {
                    $html .= "<li><label for='subfolder2'>
                    <a class='main_menu_link' href='" . URLROOT . '/index/' . $menu['items'][$itemId]['blog_id'] . "'>" . $menu['items'][$itemId]['title'] . "</a>
                    </label> 
                    <input class='main_menu_checkbox' type='checkbox' name='subfolder2'/></li>";
                }
            }
            if (isset($menu['parents'][$itemId])) {
                // node with children
                if (isAdminLoggedIn()) {
                    $html .= "<li><label for='subfolder2'>
                    <i style='color: grey;' id='mmAddChild" . $menu['items'][$itemId]['blog_id'] . "' onclick='mmAddChild(" . jsonEncodeMenu(NULL, $menu['items'][$itemId]['blog_id'], $menu['items'][$itemId]['title']) . ")' class='fa fa-plus mm_add_child_icon' aria-hidden='true'></i>
                    <i style='color: grey;' id='mmEditTitle" . $menu['items'][$itemId]['blog_id'] . "' onclick='mmEditTitle(" . jsonEncodeMenu(NULL, $menu['items'][$itemId]['blog_id'], $menu['items'][$itemId]['title']) . ")' class='fa fa-pencil mm_edit_title_icon' aria-hidden='true'></i>
                    <a class='main_menu_link' style='color: " . $permission_color . ";' href='" . URLROOT . '/index/' . $menu['items'][$itemId]['blog_id'] . "'>" . $menu['items'][$itemId]['title'] . "</a>
                    <i style='color: grey;' id='mmDeleteBranch" . $menu['items'][$itemId]['blog_id'] . "' onclick='mmDeleteBranch(" . jsonEncodeMenu(NULL, $menu['items'][$itemId]['blog_id'], $menu['items'][$itemId]['title']) . ")' class='fa fa-times mm_delete_branch_icon' aria-hidden='true'></i>
                    </label>
                    <input class='main_menu_checkbox' type='checkbox' name='subfolder2'/>";
                    $html .= createTreeView($itemId, $menu);
                    $html .= "</li>";
                } else {
                    $html .= "<li><label for='subfolder2'>
                    <a class='main_menu_link' href='" . URLROOT . '/index/' . $menu['items'][$itemId]['blog_id'] . "'>" . $menu['items'][$itemId]['title'] . "</a>
                    </label>
                    <input class='main_menu_checkbox' type='checkbox' name='subfolder2'/>";
                    $html .= createTreeView($itemId, $menu);
                    $html .= "</li>";
                }

                // for displaying mmDropDown All items
                $GLOBALS['HAS_CHILDREN_MM_DROP_DOWN'] = "true";
            }
        }
        $html .= "</ol>";
    }
    return $html;
}

/**
 * @goal   get all ids of a certain branch without root id
 * @param  array $elements , string $parentId
 * @return array
 */
function getBranchIds(array $elements, $parentId)
{
    $branch = array();

    foreach ($elements as $element) {
        if ($element['parent_id'] == $parentId) {
            $children = getBranchIds($elements, $element['blog_id']);
            if ($children) {
                foreach ($children as $child) {
                    array_push($branch, $child);
                }
            }
            array_push($branch, $element['blog_id']);
        }
    }

    return $branch;
}

/**
 * @goal   get keywords from title of a page blog or just website name
 * @param  string $blog_title
 * @return string
 */
function getKeywords($blog_title)
{
    $keywords = '';

    if (preg_match("#^" . URLROOT . '/index/' . "[0-9]+$#", URLCURRENT)) {
        $aKeywords = explode(" ", $blog_title);
        $aKeywordsSize = count($aKeywords);
        for ($i = 0; $i < $aKeywordsSize; $i++) {
            $keywords .= $aKeywords[$i] . ', ';
        }
        $keywords .= $blog_title;
    } else {
        $keywords = SITENAME;
    }

    return $keywords;
}

/**
 * @goal   get keywords from title of a page blog or just website name
 * @param  bool $state
 * @result html
 */
function websiteIsDown($state)
{
    if($state){ ?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
        body, html {
          height: 100%;
          margin: 0;
        }
        .bg {
          /* The image used */
          background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAyAAAAJYCAMAAACtqHJCAAAAe1BMVEV2uQH4+/VBRkzy9+zC3qPq9N9ZXmMzOT////+anaB/vRPX6cT8/fvj8NKEwCaNxD6jpqjS57HS09R3e3/p6ep2uAGv1Xlqb3OUx1De3+C62pNLUVay1oWfzV2izmy4urysr7GHio7J4q1gZWp5uwvExcc4PkRTWF3J5Jp+lUrdAAAWRklEQVR42u3dh3LqVgKAYbDAyPTebKrbff8nXCOBa9lwwDZI378zyWazSTzR/eboFEmFiqQvK/hXIAEiASIBIgEiASIBIgEiASIBIgkQCRAJEAkQCRAJEAkQCRAJEAkQSYBIgEiASIBIgEiASIBIgEiASAJEAkQCRAJEAkQCRAJEAkQCRAJEEiASIBIgEiASIBIgEiASIBIgkgCRAJEAkQCRAJEAkQCRAJEAkQCRBIgEiASIBIgEiASIBIgEiASIJEAkQCRAJEAkQCRAJEAkQCRAJEAkASIBIgEiASIBIgEiASIBIgEiAeJfgQSIBIgEiASIBIgEiASIBIgEiCRAJEAkQCRAJEAkQCRAJEAkQCRAJAEiASIBIgEiASIBIgEiASIBIgkQCRAJEAkQCRAJEAkQCRAJEAkQSYBIgEiASIBIgEiASIBIgEiASAJEAkQCRAJEAkQCRAJEAkQCJOddt7vxL1QsRsl/+v3+ZDLpdu/vF4tlu311tVr1eqPby+sLlwKQE2wV/0H1p/98LOp37xftq1Xv9vrBhQEkvz7+Q/3u4mp1a1QB5G97iE+7/n27d+0yAfJXjeIzqL9Y3brnAuQvunr+VVj44arNtNZT4/F8Ph8Ob26m01Jp3anVGuVyVPxeSbd96XIBkl0gg5c2f1RIf5/8md3/pdkaz2+mpU6tHNU/H0l6BhJAMgrkPyF60dKaDUu1xsdR5X5l4g5IXoG8G3A2TualWvTeSM91A+Q3gZQKJ1syoLSG6/LbbZTlrUsHCCDPg0lh0Bx2ordzdhcPEEDeKBmXXg8kxaXZCCCAvK31xsji0RUEBJC3k5Lx+tW91j0igADyrrth49Uo4iQKIIC8n5C01i9bJAtzEUAA+XB0Zfpyp2VFCxBAPt5p3TxP2Lv2RQAB5GM3kfssQAD5ZhR5vtHqj1xNQAD5OBcp7U7+Lh31BQSQTzYPd4u+EzMRQAD5ZNF3uL3PqjvnCwggnxBp1iz4AgLId4PIduOwazULEEA+IdLabopMHl1VQAD5KOSuY6oOCCDf3GbdpAu+fUIAAeSz5slEpN73giBAAPmscdE8BBBAvtk0jKxlAQLI/xfi0gICyGdT9e1dlh1DQAD5TojDvYAA8ukJ+Hm62OtZdUAA+bSpaQgggHxTzTQEEEC+rpkuZbnJAgSQTw+dzDaHTur3ri8ggHwqpGQlCxBAvnlSPTn8PnGBAQHk83OL5umA/BGQRjGk6KlyudxoNGq1WmddKk1vhvPZuFX9yZWsvisMyK8DKR/3I8/1qNyorafz8d1xD/bWDSGAZAHIi5RybTo72oAySB4wjFxiQLICJFXSKM2PM5S0DCGAZA9I8nG12rB6hKXejoUsQP4MyOXFnl0/9Xh5ORqNer3eanXVbi8W991Jv/6FkfnhsxB7IYD8HZCj/QgP15ej3tXyfvLOSHnaPHAMSV5JunCRATlrIC9SHnvt7pthZN08wl6IiwxINoCkSkbL/qsp+2FEkjOLK1cZkOwA2XT5ykhxegCQ5ESWI4uAZAzIU6P7ZyKNcfjTt8nfwBtOAMkckErlevl8n3UTPIQkP6pvIgCSQSCVykN7twTcCdw6TE+9W8cCJJNAKpWL3SjSqB6wFeLEIiAZBVKpXHYPExL94s8KCCC/DqRSaW+FhN1l1Sz0ApJtIJXedh4SNAm5MQkBJONAKr10rh60IdIyCQEk60C2Y0i9FSKkaCcEkKwD2QpphABpONELSOaBbGfqw9DTJlcuNCCZBlJJVnujgJWsoVk6IDkAcpsMITeBW4UeKwQk40Aqi+QZqoA3yCVHgl1oQDIO5DEZQmaBe+leYw1IxoFUkvPvtcBlLF9OByTrQEbJvdJd2GETJ94ByTqQSvKU4f7vOuk4jQVILoAsw05k2QgBJB9AbsPWsZIPFi5daUCyDqSSrGPt+5YT53kByQuQbtAkZO7NJoDkA0g75GM/gyEggOQDSC9oJ2Tmm+mA5APIbciZ98HmFqsOCCDZB3KdnOg1ggACyDfLWEYQQAD5vChkndcIAkhegCRfEGlZ5gUEkK+B7PsqaxuFgADyzRzEURNA8gIkaCvdYUVAcgVkz4cKB467A+IWywNTgAASBqTs/e6A5AnIvsu83j0KSF6AhGwUNpPzKS40IDkAkrzl/S5gn9BGOiA5APKQvOPdE7eAAPJpjyGneS1iAZIXIEHPgyQ/7KMLDUj2gYQ8UZjM0WPXGZAcAAn4WdMn0s3RAckDkEXAFxDWm7+m7ToDkgMgIUexIq+uBiQnQJJV3ri6/0dufR0EkDwAeQx49ejU01KA5AXIKuDl1WVn3QHJC5CAOXpyh+WkIiC5AFLf/yxvyQsbAMkLkF7AQZPIHRYgeQGS3GGt9z/JGz+4yoBkH8hDwFduG9awAMkLkPb+d1jj2C4hIHkB0t/7Bx3UnMMCJC9AkgGkvtcaVqvuHBYgeQEy2fuoe/pCrL5LDEgOgCQDyH5v/BkbQADJC5DLeP9npWoGEEDyAqS7/wwk3QMxgACSAyCJj/1+yrvkh5y4wIBkH0g6ASnv9UKs5BRWPHKBAck8kOQQVlzcZ4Y+SGfojikCkn0gqY89z7knh0zia9cXkKwDSe+v9vwRS2bogPwdkPj3gFyk8/M9V3hndYdMAMkDkNEkwMegGcW+CQJI9oE8LFMeez4Fkm4RusECJONA2v2tj2nAVzvdYAGSbSCj7ewjjvb8rG3ystG4bwULkAwDud3xiBt7flEq3QGxRQhIhoE8jx5xcc9X8RZaRRMQQLINpD3Z8ajX9hw+CtsFLBMQQI4JJOm/2/hJILfL+vM/orHvF58LzXLqw4tMAMkikMuXwSOOy/N9eQy2PiaPrisgWQNy3Vv2X/7ucWNYKASOH33vMQEkQ0AuLnurZTeKX1ebFQb7Dh93Wx+RBSxAzhDIxabrTZe3o15vtbq6Wi7uu/16/L7iulUIqJUaq/MByI8AOY3qteFdCI/BLPVR5AOQzAIp1obNwmAQAmRYd38FSJaBRLXprFAI07E7fxX3+QAka0CK5dp6Ot/sCIbqKDTT87vxxPoVIOcKpLgp2lQuN2q12npdmt7MZ61kxhFMIz1+tV0C6zqgCMjRgRz6qzOwQfqbY/yzp9uFMPvngPwIkLNu0GpshyjnEwH5NSDV2b9GVK9HjX+z6mkDuSmangPyy7dYzX/FV3OHf83T5fE8fHQfXUpAfgfIXXpPH93E8U0y+61P706Tx12p7vYKkF++xWo24rgcx41qNY6r1e0fnOQgMt+d37K6C8ivAWlFcTTrxOVqYQOkUC3HnVkUR62T4zHe3V3FS1cRkJ8F8nKT1YziRrMVx08gEiCFzX9vNuLoxMaQVm3Ho2v4AOTXgNw14ka10EleRJUCKazjTqHaiBunNA9pdZ7PAJt9APKLt1jTzVDRjOPmC5Dkj5pRPD0VHYNx7ZnHwt45IL8IpFmPa8NhJ46GT21WsTa/j+LOcFiL681Tu7lydwXILwBJbq+2t1j/vjtM9e9EdgZf/0z95aNLCMhPAxls5yDVYtx5Kk5++/73cfE09tTHtbdP53bNQgD54VusHZBZXN7cw8TFlEs6BykUips1rUI5np3GFOTJyLTx+kHdumEEkF+Zg/xLbqNmceMtkEZC49+p3GMlh4Crw9qr4zDxvdkIID8PJJUwjDuFN0A68fCVmxMxMijczV8b6fZcS0B+7BYr/VUXxeNqtfo0VFQ3bdZ3k/+S/g/jODq53fTqTeMVEed5AflZIPX/88KRkzzPuy5a9gXkJ1exzhvIZhgpxzYOAfkFIGd3i7Vb1pq/3Gk5uQiISfrHZs9EJqYigBwbyHYIOZdl3s8WtQYvo8jiwmUF5HhABs/vFjmLjcJvXq6422L3fDogxwWym+6ew1GTb0aRu+luRWvpDUCAHH8OchaHFf/bUV9P4QLyA0DO4bj7f3xQvW5nHZCjAzmLB6b+T7v39HrWEJDjA/nkkdvOCT5y+/1UZFj0ql5AfgbI2by04Vsiu9fJmYgAciQgg/N77c93Qu7W1nsBORqQzUbINy+Oa5zqi+O+fTC37oOFgBwFyGBwtq8e/W4QmW0nIhazADkUyMeFoLN5efV3E5GIEEB+YgRJ9tTP5vMHXy9mbT+bbkMEkMPnIFls0GyYhwByJCDp27G+ovLmfx+cCajBoJoKiaz2AhIO5KCPcgaUfsaz3Nh8yLPT2XzJczgft5o/KWTy6DoD8ttAjlw9Kjc66+m8dcwVs0E1nYd0XWdAzhzIxkj623KtNG8ebR5CCCBZAfK68nrYPMpd1na118lFQDIFZDOUNKbHOOAyTvd0TNQBORDIf/rl9vLr9/IirOunHi9vR6Neb7VaXbWXi/tudxJ9MZBMDx5HBsN0ou4ZQ0B+F8hxf46H69vR6mp5P3k/jtTmhxJJTy4uXGtAzhjIi5THXrv7dhi5OXA3v+HMCSCZAZJ2+wZJVDqISCuZhvS9DQiQzAB56nr1ykhxWj1gKWvoJguQQ4CU9vsV9ztANkbaL1OSKPzQ/WDQsZIFSAaBPDW6f5mLzMP3C5NVsonLDUjWgDwNI8tnIrXgjZGh7UJAMgqkUrl4JlK8CRxCCunLgMzTAckgkCcii+dBJHDnsFX3cQRAMgukUrnezUWi2SHbhYYQQLIJpFIZ9bdEwt7x2Cxa6gUky0Aqld1UpBMkZGoIAeR3gJT/CEhltN0WqYVsiVQjsxBAsg2kcr3dXK9Vg4cQlxyQ7AKpVNpbISFDSNFeCCBZB1LpBc9DBmvb6YBkHshOSMBaViv5C70mC5BMA9kKqQfsh9Ss9AKSfSBbIdH+E/V5IstFByTbQLYz9fX+Q0jk0UJAcgCkkqz21sdh503cYwGSdSDX9bC13rF7LEDyAGR7kzUOu8eyjgVI1oFUJmFDyNpxE0ByASRZyarv/XDIzF4hILkAUukH/OBPJcdNfEAdkMwDSWYh5bC9wpXrDkjWgVyETdOnJiGA5AJI5T5os3BsEgJIPoD0wu6xip4rBCQXQCrJZuHeb8pq2AkBJB9AknusvV+UVdr8VVcuPCCZB7IK2itM3rF478IDknkgj8mh930fK9w8NVXvu/CAZB5IJTlY1TRLBwSQryche7/yvexLCIDkA0g76LRJzUNTgOQDyCrk9Sbpu00sYwGSfSCXQVuFNw6bAJIPIMlxrGLQmxus8wKSfSCVZEFq35ebOI0FSF6ATAIO9N41k29Cu/KAZB9I0DrvnRc3AJITIIug01h2CgHJCZB20Et6I0/dApIPIFdBO4XJj//o0gOSeSCroIcKnTUBJE9A9j7w7pEpQHICpAcIIIAAAggggAACCCCAAHIeQKxiAQLIif/4gAACCCCA/Flh+yCOmgCSJyAdQAAB5Gg/fKGQvLL0waUHJPNAgk7zVpMHdV15QLIPJOh5EK9WBCQvQIKeKEw+U9h15QHJPpB+wAcQBt5qAkhegCRfYbvzETZAAPms65DXu6efSvcZT0CyD2S0+Tka3s0LCCBH+9mdNAEkN0CSVd6hfUJAADneIlbLixUByQeQy6A5ulVeQHICpB10VNFXbgHJCZBJ0ItHax64BSQXQJKP3Nb3/oanw+6A5APIMuhpKXN0QHICpB5yhzUYbv6qhesOSNaBJFP04r6flyp0HDQBJBdA+kEvrk6nIPbRAck6kGQA2XeX0BQEkJwAuSjGcVzfe4qennU3BQEk60CSY1j1vQeQ9K2KpiCAZBxIctA9YAbSrNsFAST7QK6TGXq09yZh4cY30gHJAZBuHHTQvTBI7rDarjogmQaSrmDtP0Pf3mE9uuqAZBlI8sLRkBuswdQdFiCZB5K80j2uz/YfQNIf3B0WIFkGkvrY/5h7oTBIXhlnDQuQLAPZ+lgHjB/poyAeJgQkw0C2PgIm6IO7dIruhT+AZBdIe+vjLmQAWTuHBUimgVx0D/AxaBZN0QHJMpDLySHjR/q2Bi/EAiSrQHrF1EcniMd2APHSakCyCeRhmfLY+4NSbweQC1cckCwCGW1vr4rzMB6DVt0AAkhWgVwstsNHuRU4fqR7IAYQQLIIZLu4G8edaiCP7Sa6JSxAsgek3d/yKA4Lg9ABpGwPBJBMAmlPdsNHrVkI7sYAAkgWgTyPHnE0DOdRaBV92RaQzAG5XNZ3POql6gE+tjP0R1cbkMwAuWh34+dqrUN4bG+wLPECkhUgF6v7+BWP8UE8Cuke+sQhE0CyAOTh9vXYEddrB/LYvgsrvnWtATlzIA+PvTc44ri4bh3KY3vGxA0WIOcL5OF6tLpaTOJ3NW6qhcHgQB+zuhssQM4SyMXjbW91tbzv9uNPKpdah+soDJrJ69x9cw2QkwNykXS96fKp29Go11utVlft5eK+O+lHz7OMjzjqjekxdDx117BFCMifADmk+mcqdn+uvJ5XC8cqeczWFiEg5wXkSxu16ex4OHZfO4j73vQDyHkDiRq10nC8eZR2cEwf89gEBJCzBVJ8YtFZT4ez1pOMwWBwVBsvC1he9APISQIpJkWbyk81Go1a7QlEaTq9Gc7HrfRs7mDwEzLSxkUTdED+AsgBq66DrYoj30t9fYTXBB2QMwLyi7XSdeSup2wBAeST+6vUx8QCFiCAfDn/mDy6woAA8nF9N/XRd4QXEEA+eUKqzgcggHx/wD2eXLq8gADyvmotNv8ABJCvpufbbUzru4AA8sn0Y/sOePuDgADy5e2V8yWAAPLxIMts+xRW3/lEQAD58PRgafsYVtfyFSCAfDU79wITQAD5evhwewUIIB+fjdoNH12nEwEB5F3NTmz1ChBAvtr72L1CyOwcEEC+vLsyfAACyIcHB3dbg2YfgADyYfKx3r2BLjJ8AALIex7F3fCxcDQREEDe8ig98zA5BwSQd3OPl9Gj7+4KEEDerlzVXr7viQcggLw5VTJsvLy/cenLOIAA8vpM4su9FR6AAPJ2Yn7zavCoLy1dAQLIy+OCN7VX390xNQcEkNdjx2sdcdehdkAAeV60Kr354kJ9ad8DEEC2OKa14pvvjnRXrhoggGw2A+elxlsc8aT96JoB8ttAkk5qPj4ert/b2OhwawVIvoFUx/PpuhF98gH1rrEDkLwCuWuN5zfTda1c/Pxzh5Nlz44gILkA0nyq1RrP5vPhzbS07tQaja9YPOOwHwjInzWKT7f+/dUIDkD+tIfTtDFZsAHISbQ6KRj1yf1yNfJ0OSCEvGbRn9wv2qvepUEDkJO7x6pct7u/ZyEqFqP+ZNLt3t8vlldXq97o9hELQCRAJEAkQCRAJED8K5AAkQCRAJEAkQCRAJEAkQCRAJEEiASIBIgEiASIBIgEiASIBIgEiCRAJEAkQCRAJEAkQCRAJEAkQCQBIgEiASIBIgEiASIBIgEiASIBIgkQCRAJEAkQCRAJEAkQCRAJEEmASIBIgEiASIBIgEiASIBIgEiASAJEAkQCRAJEAkQCRAJEAkQCRBIgEiASIBIgEiASIBIgEiASIBIgkgCRAJEAkQCRAJEAkQCRAJEAkQDxr0ACRAJEAkQCRAJEAkQCRAJEAkQSIBIgEiASIBIgEiASIBIgEiASIJIAkQCRAJEAkQCRAJEAkQCRAJEEiASIBIgEiASIBIh0Pv0PThSYdP/epToAAAAASUVORK5CYII=');
          /* Full height */
          height: 100%;
          /* Center and scale the image nicely */
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
        }
        /* Bottom right text */
        .text-block {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background-color: rgba(0, 0, 0, 0.5);;
            color: white;
            padding-left: 20px;
            padding-right: 20px;
            font-family: Arial, Helvetica, sans-serif;
        }
        .text-block h1 {
            color: #f44336;
        }
        </style>
    </head>
    <body>
    <div class="bg"></div>
    <div class="text-block">
        <h1>Downtime</h1>
        <h2>Sorry, we are down for scheduled maintenance right now. Please check back soon.</h2>
    </div>
    </body>
</html>
<?php
        exit;
    }
}
