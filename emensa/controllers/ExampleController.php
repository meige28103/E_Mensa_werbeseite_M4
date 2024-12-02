<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');


class ExampleController
{
    public function m4_7a_queryparameter(RequestData $rd) {
        /*
           Wenn Sie hier landen:
           bearbeiten Sie diese Action,
           so dass Sie die Aufgabe löst
        */

        return view('examples/m4_7a_queryparameter.blade.php', [
            'request'=>$rd,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }
    public function m4_7b_kategorie(RequestData $rd) {
        $kategorien = db_kategorie_select_name();
        return view('examples.m4_7b_kategorie', [
            'kategorien' => $kategorien
        ]);
    }
    public function m4_7c_gericht(RequestData $rd) {
    $gerichte=db_gericht_ueber2();
        return view('examples.m4_7c_gericht', [
            'gerichte' => $gerichte
        ]);
    }
    public function m4_7d_layout(RequestData $rd) {
        $pageNumber = $rd->query['no'] ?? '1';

        if($pageNumber == '2'){
            return view('examples.pages.m4_7d_page_2',
                ['rd' => $rd]);
        }
        else{
            return view('examples.pages.m4_7d_page_1',
                ['rd' => $rd]);
        }

    }
}