<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Development Class - December 7, 2019</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        h1, h2, h3 {
            color: #333;
        }
        ul {
            list-style-type: disc;
            margin-left: 20px;
        }
        a {
            color: #1a0dab;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>App Development Class - December 7, 2019</h1>
    <h2>Instructor Information</h2>
    <ul>
        <li>Name: 장희성</li>
        <li>Phone Number: 010-8824-5558</li>
    </ul>
    <h2>Class Links</h2>
    <ul>
        <li><a href="https://codepen.io/jangka44/debug/rNaORbO?editors=1000" target="_blank">Spring Boot Installation Manual</a></li>
        <li><a href="https://gist.github.com/jhs512/167101701fdb3c07fb65f4405b0c82a0" target="_blank">Practical pom.xml, application.yml</a></li>
        <li><a href="https://code.oa.gg/java8/1540" target="_blank">Java: Getting the Current Time</a></li>
    </ul>
    <h2>App Development 1 Start</h2>
    <h3>December 7, 2019 - Day 1</h3>
    <h3>Concepts</h3>
    <ul>
        <li><strong>Controller:</strong> In a program, a controller can be compared to a front desk staff member in a building, handling customer requests at the forefront.</li>
        <li><strong>Controller's Responsibility:</strong> The controller doesn't handle everything by itself; it delegates tasks it cannot perform to other departments (usually services).</li>
        <li><strong>@Controller:</strong> Indicates to the Spring Framework that the class is a controller.</li>
        <li><strong>@RequestMapping:</strong> Maps requests to methods.</li>
        <li><strong>@ResponseBody:</strong> Uses the method's return value as the response.</li>
    </ul>
    <h3>Problems</h3>
    <ul>
        <li><a href="https://gist.github.com/jhs512/c213b9659d4d8625af41771e76a92847" target="_blank">Concept - Spring Boot Controller</a></li>
        <li><a href="https://gist.github.com/jhs512/8c24a0afdfa5a8eb3e7ff5de615be9af" target="_blank">Concept - Spring Boot Controller 2</a></li>
        <li><a href="https://gist.github.com/jhs512/59cefec5a47dba99298fc2c73a25dd43" target="_blank">Concept - Spring Boot Controller 3</a></li>
        <li>Problem 1
            <ul>
                <li>Request 1: /home/addArticle?title=Title&body=Content</li>
                <li>Response 1: {"id":1,"title":"Title","body":"Content"}</li>
                <li>Request 2: /home/addArticle?title=Title2&body=Content2</li>
                <li>Response 2: {"id":2,"title":"Title2","body":"Content2"}</li>
                <li>Request 3: /home/addArticle?title=Title3&body=Content3</li>
                <li>Response 3: {"id":3,"title":"Title3","body":"Content3"}</li>
            </ul>
        </li>
        <li><a href="https://gist.github.com/jhs512/1cef14e467c372868538848dddf320e9" target="_blank">Problem - Solution</a></li>
        <li>Problem 2
            <ul>
                <li>Request 1: /home/addArticle?title=Title&body=Content</li>
                <li>Response 1: 1st article has been created.</li>
                <li>Request 2: /home/addArticle?title=Title2&body=Content2</li>
                <li>Response 2: 2nd article has been created.</li>
                <li>Request 3: /home/addArticle?title=Title3&body=Content3</li>
                <li>Response 3: 3rd article has been created.</li>
                <li>Request 4: /home/getArticles</li>
                <li>Response 4: [{"id":1,"title":"Title","body":"Content"},{"id":2,"title":"Title2","body":"Content2"},{"id":3,"title":"Title3","body":"Content3"}]</li>
            </ul>
        </li>
    </ul>
</body>
</html>
