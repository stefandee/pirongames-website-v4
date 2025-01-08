for /F %%A in ('dir /B/D *.css') do java.exe -jar E:\Home\Karg\Projects\Web\yuicompressor-2.4.7\build\yuicompressor-2.4.7.jar -o ".\compact\%%A" "%%A"
