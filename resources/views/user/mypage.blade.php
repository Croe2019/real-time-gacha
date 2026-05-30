@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-5xl mx-auto px-4">

            {{-- タイトル --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">
                    マイページ
                </h1>
                <p class="text-gray-500 mt-1">
                    アカウント情報を確認できます
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- 左：プロフィール --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow p-6">

                        {{-- アイコン --}}
                        <div class="flex flex-col items-center">

                            <div
                                class="w-24 h-24 rounded-full bg-indigo-500 flex items-center justify-center text-white text-4xl font-bold"
                            >
                                {{ mb_substr(auth()->user()->name, 0, 1) }}
                            </div>

                            <h2 class="mt-4 text-xl font-semibold text-gray-800">
                                {{ auth()->user()->name }}
                            </h2>

                            <p class="text-gray-500">
                                {{ auth()->user()->email }}
                            </p>

                            <span
                                class="mt-4 inline-flex px-3 py-1 text-sm rounded-full bg-green-100 text-green-700"
                            >
                            利用中
                        </span>
                        </div>

                        <div class="border-t mt-6 pt-6 space-y-4">

                            <div>
                                <p class="text-sm text-gray-500">
                                    登録日
                                </p>
                                <p class="font-medium text-gray-700">
                                    {{ auth()->user()->created_at->format('Y/m/d') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    最終ログイン
                                </p>
                                <p class="font-medium text-gray-700">
                                    {{ now()->format('Y/m/d H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 右：設定・活動情報 --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- アカウント設定 --}}
                    <div class="bg-white rounded-2xl shadow p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">
                            アカウント設定
                        </h3>

                        <div class="grid md:grid-cols-2 gap-4">

                            <a
                                href="{{ route('profile.edit') }}"
                                class="block rounded-xl border p-5 hover:bg-gray-50 transition"
                            >
                                <h4 class="font-semibold text-gray-800">
                                    プロフィール編集
                                </h4>
                                <p class="text-sm text-gray-500 mt-2">
                                    名前やメールアドレスを変更します
                                </p>
                            </a>

                            <a
                                href="{{ route('password.request') }}"
                                class="block rounded-xl border p-5 hover:bg-gray-50 transition"
                            >
                                <h4 class="font-semibold text-gray-800">
                                    パスワード変更
                                </h4>
                                <p class="text-sm text-gray-500 mt-2">
                                    パスワードを更新します
                                </p>
                            </a>

                        </div>
                    </div>

                    {{-- 活動情報 --}}
                    <div class="bg-white rounded-2xl shadow p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">
                            アクティビティ
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            <div class="rounded-xl bg-indigo-50 p-5">
                                <p class="text-gray-500 text-sm">
                                    投稿数
                                </p>
                                <p class="text-3xl font-bold text-indigo-600">
                                    0
                                </p>
                            </div>

                            <div class="rounded-xl bg-green-50 p-5">
                                <p class="text-gray-500 text-sm">
                                    コメント数
                                </p>
                                <p class="text-3xl font-bold text-green-600">
                                    0
                                </p>
                            </div>

                            <div class="rounded-xl bg-orange-50 p-5">
                                <p class="text-gray-500 text-sm">
                                    ログイン日数
                                </p>
                                <p class="text-3xl font-bold text-orange-600">
                                    0
                                </p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
