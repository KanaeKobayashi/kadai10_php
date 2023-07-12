-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023 年 7 月 12 日 17:03
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `kadai_PHP10`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bm_table`
--

CREATE TABLE `gs_bm_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `bookTitle` varchar(128) NOT NULL,
  `author` varchar(128) NOT NULL,
  `rating` int(12) NOT NULL,
  `comment` text NOT NULL,
  `thumbnail` varchar(512) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `name`, `email`, `bookTitle`, `author`, `rating`, `comment`, `thumbnail`, `date`) VALUES
(1, 'かなえ', '123@nnn.ne.jp', 'ブラック企業の社員が猫になって人生が変わった話 モフ田くんの場合', '清水 めりぃ', 2, 'kindle unlimitedで読めます\r\n猫になった主人公がブラック企業をホワイト化していく漫画\r\nhttps://amzn.asia/d/75GAGf3', 'http://books.google.com/books/content?id=LNOGDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-06-25 15:52:12'),
(2, 'みつこ', '12345@nnn.ne.jp', 'BRUTUS特別編集 増補改訂版 猫だもの。', 'BRUTUS編集部', 3, '猫だもの\r\nhttps://amzn.asia/d/a7t9BMV', 'http://books.google.com/books/content?id=S9_XzwEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-06-25 16:02:20'),
(3, 'かなえ', '123@nnn.ne.jp', '親父と猫 定年後に待っていた猫ライフ', 'Turi', 3, '70歳、定年退職。\r\nそんな親父が子猫を拾ってきた。\r\nhttps://amzn.asia/d/8ZpnxmN', 'http://books.google.com/books/content?id=yG-4EAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-06-25 16:07:43'),
(4, 'かなえ', '123@nnn.ne.jp', 'ころばぬさきのねこ　〜病気にならない猫の飼い方〜', '伊藤裕行', 1, '読んでて思わずキュンとなってしまいます。\r\nhttps://amzn.asia/d/hisJsja', 'http://books.google.com/books/content?id=HEXwzwEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-06-25 16:12:57'),
(5, '花子', '456@uuu.nn.jp', 'うちの猫がまた変なことしてる。3', '卵山 玉子', 3, '可愛いねこの漫画ブログに癒されます\r\nhttps://amzn.asia/d/d9Ys1nC', 'http://books.google.com/books/content?id=UAU3DwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-06-25 17:00:16'),
(6, '花子', '456@uuu.nn.jp', 'PHPフレームワークLaravel入門 第2版', '掌田 津耶乃', 5, 'PHPのフレームワークに行きたいような・・・\r\nhttps://amzn.asia/d/a8sU0uB\r\n', 'http://books.google.com/books/content?id=Y3vlDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-06-25 17:02:13'),
(7, 'サラミ', '567@ooo.nn.kk', '月刊PHP 2023年6月号', 'PHP編集部', 4, 'PHP違い😆', 'http://books.google.com/books/content?id=seS_EAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-06-26 22:28:05'),
(8, 'まりこ', 'shi@mmm.hh.kk', 'アルゴリズム図鑑 増補改訂版 絵で見てわかる33のアルゴリズム ', '石田 保輝', 4, 'とてもわかりやすいので甥っ子と読んでます。\r\nhttps://amzn.asia/d/aGS6E50', 'http://books.google.com/books/content?id=8zCwEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-06-27 19:21:22'),
(9, 'つくし', 'kashi@mipp.nn.jj', 'Ruby on Rails 7ポケットリファレンス', 'WINGSプロジェクト 山内 直', 4, 'ルビィって美味しいの？私は人造ルビーはたくさん使ってましたが・・・\r\nhttps://amzn.asia/d/4cJHM1e\r\n', 'http://books.google.com/books/content?id=AeZUzwEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-06-27 19:42:23'),
(10, '真由美', 'vvv@kk.nn.ll', 'コミュニティ・オーガナイジング――ほしい未来をみんなで創る5つのステップ ', '鎌田華乃子', 4, '仲間を集めてその輪を広げ、多くの人が共に行動することで社会変化を起こす。\r\nhttps://amzn.asia/d/2Wsy09N', 'http://books.google.com/books/content?id=220YzgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-06-27 21:34:26'),
(11, 'さやか', 'cvcv@ll.hhs.ff', '求道ー日本的生き方の実践ー', '井上 敬康', 4, '私のための道を極める\r\nhttps://amzn.asia/d/hhAON5c', 'http://books.google.com/books/content?id=OtVJzwEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-06-27 21:37:13'),
(17, '坊主', 'boose@kk.nn.hh', '最高の集い方 記憶に残る体験をデザインする', 'プリヤ・パーカー', 4, '盛り上げるための秘訣\r\nhttps://amzn.asia/d/7QzsZki', 'http://books.google.com/books/content?id=fQUqywEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-06-27 21:42:34'),
(18, 'かなえ', '123@nnn.ne.jp', '完全版上杉鷹山', '童門 冬二', 5, '私はこの人の考え方が好きです。ケネディ大統領も参考にしたと聞いています。\r\nhttps://amzn.asia/d/92bonp0', 'http://books.google.com/books/content?id=nmftxgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-06-27 21:53:13'),
(31, '清子', 'sayako@example.com', '設計部門改革バイブル', '谷口潤', 4, 'BOMが大切ってわかっちゃいるけど・・・', 'http://books.google.com/books/content?id=JTdIzQEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-07-05 00:07:35'),
(32, 'かなえ', '123@nnn.ne.jp', '猫のいる日々', '大佛次郎', 3, 'やっぱり猫がいないとね', 'http://books.google.com/books/content?id=a538oAEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-07-05 00:49:04'),
(34, '都', 'miyako@example.com', 'ねこのおもちゃ絵', '長井裕子', 4, '猫がおもちゃだから', 'http://books.google.com/books/content?id=qV_mjgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-07-05 07:27:08'),
(35, 'すみか', 'sumika@example.com', 'おうちで学べるプログラミングのきほん', '河村進', 3, '基本がやっぱり大切', 'http://books.google.com/books/content?id=qw8fBAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-07-05 07:39:08'),
(36, 'マリア', 'maria@example.com', '猫語レッスン帖', 'Unknown Author', 4, '猫と会話したいと思うのは私だけではないでしょう。\r\nhttps://amzn.asia/d/5uQMju3', 'http://books.google.com/books/content?id=aEiXMQEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-07-05 19:49:51'),
(39, 'かなえ', '123@nnn.ne.jp', 'ものぐさ自転車の悦楽　折りたたみ自転車で始める新しき日々', '疋田智', 5, 'うちのさけぶろ（ブロンプトン）に乗って、旅行に行きたい。\r\n折りたたみ自転車を買うときにかなりしっかり読みました。', 'http://books.google.com/books/content?id=GGG5DAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-07-05 21:21:07'),
(41, 'かなえ', '123@nnn.ne.jp', '経営企画部が日本企業をダメにする', '中村和己', 3, 'ストーリーで勝てるほど 事業開発は甘くない!ってそりゃそうだ。中身はやっぱり必要だよね。', 'http://books.google.com/books/content?id=--xdDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-07-12 22:01:18'),
(42, 'かなえ', '123@nnn.ne.jp', '猫にひろわれた話', '猫びより編集部', 3, '猫日和〜', 'http://books.google.com/books/content?id=bkFbEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-07-12 22:52:34'),
(43, 'みつこ', '12345@nnn.ne.jp', '猫にひろわれた話', '猫びより編集部', 3, '猫日和〜', 'http://books.google.com/books/content?id=bkFbEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-07-12 23:20:38'),
(44, 'みつこ', '12345@nnn.ne.jp', '猫にひろわれた話', '猫びより編集部', 3, '猫日和〜', 'http://books.google.com/books/content?id=bkFbEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-07-12 23:34:09'),
(45, 'かなえ', '123@nnn.ne.jp', '猫にひろわれた話', '猫びより編集部', 3, '猫日和〜', 'http://books.google.com/books/content?id=bkFbEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-07-12 23:34:09');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_user_table`
--

CREATE TABLE `gs_user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `nickName` varchar(64) NOT NULL,
  `lid` varchar(128) NOT NULL,
  `lpw` varchar(64) NOT NULL,
  `kanri_flg` int(1) NOT NULL DEFAULT 0,
  `life-flg` int(1) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `gs_user_table`
--

INSERT INTO `gs_user_table` (`id`, `name`, `email`, `nickName`, `lid`, `lpw`, `kanri_flg`, `life-flg`, `date`) VALUES
(1, '管理者', 'kanri@example.com', 'かんり', 'administrator', 'admin', 1, 0, '2023-07-10 20:07:18'),
(2, '沙織', 'abc@example.com', 'さお', 'test02', 'test02', 0, 0, '2023-07-10 20:52:48'),
(3, 'かなえ', '123@nnn.ne.jp', 'かなえ', '123gs123', 'gs123', 0, 0, '2023-07-12 21:55:43'),
(4, 'みつこ', '12345@nnn.ne.jp', 'みつこ', 'mituko', 'mituko', 0, 0, '2023-07-13 00:02:56');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `gs_user_table`
--
ALTER TABLE `gs_user_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- テーブルの AUTO_INCREMENT `gs_user_table`
--
ALTER TABLE `gs_user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
