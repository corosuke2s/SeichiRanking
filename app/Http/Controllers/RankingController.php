<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\RankingModel;

class RankingController extends Controller
{
    public function __construct()
    {
        $this->model = new RankingModel();
    }

    /**
     * ランキングTOP
     * @param string $mode
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($mode='break')
    {
        // ナビゲーションバーの判定
        $navbar_act = $this->model->set_navbar_act($mode);

        // サーバーステータスの取得
        $server_status = $this->get_server_status();

        // 整地ランキングの取得
        $break_ranking = $this->model->get_break_ranking($mode);

        // 建築ランキングの取得
        $build_ranking = $this->model->get_build_ranking($mode);

        // 接続時間ランキングの取得
        $playtime_ranking = $this->model->get_playtime_ranking($mode);

        // 投票ランキングの取得
        $vote_ranking = $this->model->get_vote_ranking($mode);

        // ページ独自CSSの設定
        $assetCss = [
//            asset('/css/index.css')
        ];

        // viewをセット
        return view(
            'index', [
                'navbar_act'       => $navbar_act,          // ナビゲーションバーの判定
                'server_status'    => $server_status,       // サーバ接続人数の情報
                'break_ranking'    => $break_ranking,       // 整地ランキング
                'build_ranking'    => $build_ranking,       // 建築量ランキング
                'playtime_ranking' => $playtime_ranking,    // 接続時間ランキング
                'vote_ranking'     => $vote_ranking,        // 投票数ランキング
                'assetCss'         => $assetCss,            // 独自CSS
            ]
        );
    }
    //
}
