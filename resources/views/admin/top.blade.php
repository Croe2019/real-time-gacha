@extends('layouts.admin')

@section('title', '管理画面')
    @section('page-title', 'ダッシュボード')

    @section('content')

        <div class="row g-4">

            <div class="col-md-3">
                <div class="card dashboard-card p-3">
                    <h6>総ユーザー数</h6>
                    <h2>120</h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card dashboard-card p-3">
                    <h6>ガチャ回数</h6>
                    <h2>350</h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card dashboard-card p-3">
                    <h6>売上</h6>
                    <h2>¥120,000</h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card dashboard-card p-3">
                    <h6>アクティブ数</h6>
                    <h2>45</h2>
                </div>
            </div>

        </div>

        <div class="card mt-5 shadow-sm">

            <div class="card-header bg-white">
                最新ユーザー一覧
            </div>

            <div class="card-body p-0">

                <table class="table table-hover mb-0">

                    <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                        <th>Email</th>
                        <th>登録日</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>田中太郎</td>
                        <td>test@example.com</td>
                        <td>2026-05-29</td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>佐藤花子</td>
                        <td>sample@example.com</td>
                        <td>2026-05-28</td>
                    </tr>
                    </tbody>

                </table>

            </div>

        </div>

    @endsection
