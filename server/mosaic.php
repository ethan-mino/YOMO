<!DOCTYPE HTML5>
<html>
    <head>
        <title>YoMo</title>
        <link rel="icon" type="image/png" href="./images/icons/favicon.ico"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <!-- 렌더링 과정 https://boxfoxs.tistory.com/408, https://jeong-pro.tistory.com/90 참고 -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/main.css">
        <link rel = "stylesheet" href = "./css/loading.css">
        <link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />
    </head>

    <body >
        <!-- navbar(상단바), shadow class를 지정하여 그림자 효과를 줌. -->
        <nav class="navbar shadow">  
            <a href="/project/mosaic.php"><img class = "navbar__img" src = "./images/YoMo_logo.png"></a>  <!-- navbar의 YoMo 로고 YoMo  폰트 : HelveticaRounded, 글자 크기 : 190, you only mosaic once 폰트 : Lucida Calligraphy, 글자크기 : 45, bold -->

            <div class = "navbar__content">
                <a href="#">Help</a>    
                <a href="#">About</a>

                <!-- 언어선택 -->
                <select class ="navbar__languge-selector">
                    <option value="en">English</option>
                    <option value="de">Deutsch</option>
                    <option value="fr">Français</option>
                    <option value="es">español</option>
                    <option value="ru">Русский</option>
                    <option selected="selected" value="ko">한국어</option>
                    <option value="ja">日本語</option>
                    <option value="zh">简体中文</option>
                </select>

                <!-- 햄버거
                <button type="button" name="button" id="menu">
                    <span>asd</span>
                    <span></span>
                    <span></span>
                </button> -->
            </div>
        </nav>
        <!-- the낙서miri, 폰트크기 160 -->

        <div class = "content-container"> <!-- video와 모자이크 대상을 선택하는 box를 감싸는 태그 -->
            <div  class = "content-container__wrap shadow">   <!-- video 태그를 감싸는 box (그림자 효과를 줌) -->
                <div class = "video-box">   <!-- https://plyr.io/?fbclid=IwAR2W6H5HL0-V_JO6mDsU-vP7S3Ye8s12WNDD_JWJrqkuVw4F8Kvy4-ErknI 참고 -->
                    <video id = "player" playsinline class = "content-container__user-video none" width="100%" height="100%" autoplay controls allowfullscreen>
                    <!-- autoplay가 설정되면, 데이터 로딩이 완료되지 않더라도 재생 가능한 시점에 자동으로 재생이 시작됨. -->
                        영상을 출력하는데 실패하였습니다. </video>
                </div>
            </div>

            <!-- 모자이크 대상을 선택하는 box -->
            <div class = "shadow form-box">
                <form class="form-box__checkbox-form" method = "post" action="http://13.209.5.188:3030/project/mosaic"> 
                    <legend>모자이크 대상</legend>  <!-- legend 요소는 fieldset 요소의 제목(LEGEND)을 표시한다. fieldset 요소를 이용하여 여러 개의 컨트롤들을 묶었으면 이 묶음이 어떤 성격 또는 용도인지 알려줄 필요가 있으며, 이때 legend 요소를 사용한다. -->
                    <div id = "checkbox_list" style = "margin-left : 10px; font-size : 12px">
                        <script>
                            function add_checkbox(checkbox_list, id_list) {  // 체크박스를 추가하는 함수 
                                for (let i = 0; i < check_element_list.length; i++) {
                                    document.write(`<label class = "checkbox">`)
                                    document.write(`<input type='checkbox' name = "option" id = ${id_list[i]}>`)
                                    document.write("<span class = 'icon'></span>")
                                    document.write(`<span class = 'text'>${check_element_list[i]}</span>`)
                                    document.write(`</label>`)
                                }
                            }

                            document.write("-유해이미지")   // 유해이미지 카테고리임을 표시함 
                            let check_element_list = ["담배", "칼"] // 유해이미지 카테고리에는 "담배"와 "칼"이 있음
                            let id_list = ["cigarette", "knife"]
                            add_checkbox(checkbox_list, id_list) // "담배"와 "칼" 체크박스를 추가함
                            document.write(`<br>`)  // 카테고리 사이의 간격

                            document.write("-개인정보") // 개인정보 카테고리임을 표시함 
                            check_element_list = ["택배운송장", "우편물", "차량번호판", "도로명 주소판", "도로 표지판", "티켓", "핸드폰 화면"]
                            id_list = ["waybill", "post", "license plate", "address plate", "road sign", "ticket", "phone"]
                            add_checkbox(checkbox_list, id_list)
                            // document.write(`<br>`)  // 카테고리와 버튼 사이의 간격
                        </script>
                    </div>
                    <input type="hidden" name = "uploadFileName" id = "uploadFileName">
                    <button class="btn btn-outline-danger form-box__mosaic-submit">모자이크 Go!</button>
                </form>

                 <form class = "form-box__upload-form" method = "POST" action = "http://13.209.5.188:3030/project/upload" enctype = "multipart/form-data">
                    <input type="file" name = "selectFile" id = "selectFile" style = "display : none" accept = "video/mp4, video/WebM, video/Ogg">   <!-- enctype 속성은 폼 데이터(form data)가 서버로 제출될 때 해당 데이터가 인코딩되는 방법을 명시 -->
                    <button type="button" onclick = "document.all.selectFile.click();" class="btn btn-outline-primary">동영상 업로드</button>
                </form>
             
                <form class= "form-box__download-form "method = "post" action="http://13.209.5.188:3030/project/download">
                    <input type="hidden" name = "downloadFileName" id = "downloadFileName"> 
                    <button type="submit" class="btn btn-outline-success form-box__download-submit">동영상 다운로드</button>
                </form>
            </div>
        </div>

        <footer class = "shadow footer">
            <div class = "footer__content-box">
                <!-- https://dalggomy2.tistory.com/10 참고 -->
                <div class="circle-img footer__img">
                    <img src="./images/footer_img.png" />
                </div>

                <div class = "footer__text">
                    상명대학교 졸업프로젝트<br>
                    AI 기반 동영상 자동 모자이크 웹 어플리케이션<br>
                    <strong>YoMo</strong>
                </div>
            </div>
        </footer>

        <div class="dark-bg dark-bg--lenient none"></div>
        <div class="infinityChrome none">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <script src="../vendor/login/jquery/jquery-3.2.1.min.js"></script>
        <script src="../vendor/login/tilt/tilt.jquery.min.js"></script>
        <script src="https://cdn.plyr.io/3.6.2/plyr.js"></script>

        <script>
            /* 동영상 다운로드 */
            $(".form-box__download-submit").click((event) => {
                event.preventDefault();

                if($("#downloadFileName").val() == ""){
                    alert("모자이크 처리된 동영상이 없습니다.")
                    return;
                }
                
                /* 로딩창 추가 */
                $(".dark-bg").removeClass("none")
                $(".infinityChrome").removeClass("none")

                const data = $(".form-box__download-form").serialize()  // serializeArray -> https://stackoverflow.com/questions/8289349/jquery-appending-to-serialize 참조

                $(".form-box__download-submit").prop("disabled", true);
                const url = $(".form-box__download-form").attr("action");

                $.ajax({    // https://sub0709.tistory.com/62 참조
                    url : url,
                    data : data,
                    type : "POST",
                    cache : false,
                    xhrFields : {
                        responseType : 'blob'
                    },
                    success : function(response, status, xhr){
                        const blob = new Blob([response]);
                        
                        const disposition = xhr.getResponseHeader('Content-Disposition')
                        let filename = ""

                        if (disposition && disposition.indexOf('attachment') !== -1) {     // indexOf() 메서드는 호출한 String 객체에서 주어진 값과 일치하는 첫 번째 인덱스를 반환한다. disposition-type이 attachment인지 확인하는 듯하다.
                            const filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                            const matches = filenameRegex.exec(disposition);  // exec() 메소드는 어떤 문자열에서 정규표현식과 일치하는 문자열 검색을 수행한다.
                            if (matches != null && matches[1]) filename = decodeURI(matches[1].replace(/['"]/g, ''));  // Content-Disposition에 한글을 사용하면 오류가 발생하기 때문에 서버에서 인코딩된 문자열을 사용했으므로, decode 해줌.
                        }

                        // 파일 저장
                        if(navigator.msSaveBlob){
                            return navigator.msSaveBlob(blob, url)
                        }else{
                            const link = document.createElement("a");
                            link.href = window.URL.createObjectURL(blob);
                            link.target = "_blank"  
                            link.download = filename;   // 다운로드 파일명
                            link.click();
                        }
                    },
                    error : function(req, status, error){
                        alert("다운로드 실패!")
                        console.log("req", req)
                        console.log("status", status)
                        console.log("error", error)
                    },
                    complete : function(){
                        $(".form-box__download-submit").prop("disabled", false);
                        /* 로딩창 추가 */
                        $(".dark-bg").addClass("none")
                        $(".infinityChrome").addClass("none")
                    }
                })
            })

            /* 모자이크 Go! */
            $(".form-box__mosaic-submit").click((event) => {
                event.preventDefault();

                const formData = []    
                //const file = $("#selectFile")[0].files[0];

                const checked = $("input:checkbox[name = 'option']:checked");   // 체크된 모자이크 대상 선택
                
                if(checked.length === 0){   // 체크된 checkbox가 없다면
                    alert("모자이크 대상을 선택해주세요!");
                    return;
                }

                checked.each((index, elem) =>{  // 체크된 각 checkbox를 list에 push, 각 객체에는 name 프로퍼티와 value 프로퍼티가 필요함
                    formData.push({name : `option${index}`, value : elem.id})
                })

                if($("#uploadFileName").val() === "") {
                    alert("모자이크 할 동영상을 업로드 해주세요!")
                    return;
                }

                formData.push({name : "filename", value : $("#uploadFileName")[0].value}) // 파일명 list에 추가
                
                /* 로딩창 추가 */
                $(".dark-bg").removeClass("none")
                $(".infinityChrome").removeClass("none")

                // submit 버튼 disable
                $(".form-box__mosaic-submit").prop("disabled", true);

                $.ajax({
                    url : $(".form-box__checkbox-form").attr("action"),
                    data : formData,
                    type : "POST",
                    cache : false,
                    success : function(response){
                        if(response.error === true){    // 서버에서 error를 응답한 경우
                            alert("모자이크 실패!")  
                        }else{
                            //alert("모자이크 성공!")
                            $(".content-container__user-video")[0].src = response.filePath
                            $("#downloadFileName")[0].value = response.fileName
                        }
                    },
                    error : function(req, status, error){
                        alert("모자이크 실패!")
                        console.log("req", req)
                        console.log("status", status)
                        console.log("error", error)
                    },
                    complete : function(){
                        $(".form-box__mosaic-submit").prop("disabled", false);
                        /* 로딩창 삭제 */
                        $(".dark-bg").addClass("none")
                        $(".infinityChrome").addClass("none")
                    }
                })
            })
            function validFileType(file){
                console.log(file.type)
                const validFileFomat = ["video/mp4", "video/WebM", "video/Ogg"]
                const isValid = (validFileFomat.indexOf(file.type) > -1)
                
                return isValid
            }

            /* 동영상 업로드 */
            // Uncaught TypeError: Illegal invocation : query ajax 를 이용하여 data를 넘길때, 제대로 된 값이 아니거나 유형이 다를경우 발생.
            $("#selectFile")[0].addEventListener("change", (event) => { 
                const file = $("#selectFile")[0].files[0];

                if(!validFileType(file)){   // 파일의 포맷을 확인하여, 지원하지 않는 포맷인 경우는 업로드 하지 않음
                    alert('지원하지 않는 동영상 포맷입니다. 현재 지원하고 있는 동영상 포맷은 "video/mp4", "video/WebM", "video/Ogg" 입니다');
                    $("#selectFile").val("")    // 선택한 파일 초기화
                    return;
                }
                
                const form = $(".form-box__upload-form")[0] // element select
                
                const formData = new FormData(form);    // formData object 생성
                
                if(file === undefined) {return;} // 동영상을 선택하지 않은 경우
                /* 로딩창 추가 */
                $(".dark-bg").removeClass("none")
                $(".infinityChrome").removeClass("none")
 
                // https://enai.tistory.com/37, https://loco-motive.tistory.com/53, https://wondongho.tistory.com/m/96, https://cofs.tistory.com/181, http://magic.wickedmiso.com/9 참조 
                $.ajax({
                    type : "POST",
                    enctype : "multipart/form-data",    // multipart는 폼 데이터가 여러 부분으로 나뉘어 서버로 전송되는 것을 의미함 (https://velog.io/@runningwater/TIL-form-%EC%A0%84%EC%86%A1-%EC%8B%9C-enctype-%ED%99%95%EC%9D%B8%ED%95%98%EA%B8%B0 참조)
                    url : $(".form-box__upload-form").attr("action"),
                    data : formData,
                    processData : false,    // 기본 값은 true이며, true일때는 data 값들이 쿼리스트링 형태인 key1=value1&key2=value2 형태로 전달된다. 하지만 이렇게 하면 file 값들은 제대로 전달되지 못하므로,  해당 값을 false로 해주어 { key1 : 'value1', key2 : 'value2' } 형태로 전달해 주어야 file 값들이 제대로 전달된다.
                    contentType : false,    // 기본값은 'application/x-www-form-urlencoded'이다. 해당 기본 타입으로는 파일이 전송 안되기 때문에 false로 해주어야 한다.
                    cache : false,
                    timeout : 600000,
                    success : function(response){
                        //alert("동영상 업로드 성공! ")
                        if(response.error === true){    // 서버에서 error를 응답한 경우
                            alert("동영상 업로드 실패! 업로드 할 동영상을 다시 선택해주세요.")  
                        }else{
                            $(".content-container__user-video")[0].src = response.filePath
                            $(".content-container__user-video").removeClass("none") // 초기 업로드 시 동영상의 none 속성을 없앰
                            const player = new Plyr('#player');

                            $(".content-container__user-video")[0].id = "player"
                            $("#uploadFileName")[0].value = response.filePath.split("/").slice(-1)[0]   // 파일명만 저장
                            $("#downloadFileName").val("")  // 업로드 성공 시 다운로드 파일 path를 지움
                        }
                    },
                    error : function(req, status, error){
                        alert("동영상 업로드 실패! 업로드 할 동영상을 다시 선택해주세요.")
                        console.log("req", req)
                        console.log("status", status)
                        console.log("error", error)
                    },
                    complete : function(){
                        $("#selectFile").val("") // 선택한 파일을 지워서, 같은 이름의 파일을 선택하더라도 change 이벤트가 발생하도록 함

                        /* 로딩창 삭제 */
                        $(".dark-bg").addClass("none")  // TODO: 로딩창이 사라지기 전에 alert가 먼저 표시되는 문제 해결
                        $(".infinityChrome").addClass("none")
                    }
                })    
            })

            $(function() {
                /* 햄버거 메뉴 동작 */
                $('#menu').click(function() {
                    $('#menu>span').toggleClass('on')
                })
            })
        </script>
    </body>
</html>
