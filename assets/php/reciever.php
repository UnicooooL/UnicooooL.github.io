<?php
// 检查请求是否是POST方法
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // 获取表单数据
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // 检查数据是否被正确填写
    if (empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($message)) {
        // 可以在这里设置一个错误消息并重定向回表单
        echo "Please complete the form and try again.";
        exit;
    }

    // 接收邮件的邮箱
    $recipient = "lynne.liukail@gmail.com";

    // 设置邮件主题
    $subject = "New contact from $name";

    // 构建邮件内容
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // 构建邮件头部
    $email_headers = "From: $name <$email>";

    // 发送邮件
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // 邮件成功发送的处理
        echo "Thank You! Your message has been sent.";
    } else {
        // 邮件发送失败的处理
        echo "Oops! Something went wrong and we couldn't send your message.";
    }

} else {
    // 不是POST请求时的处理
    echo "There was a problem with your submission, please try again.";
}
?>
