<?php
    namespace App\Http\middleware;

    use App\Auth\Auth;
    use App\Http\Request;

    class GuestMiddleware{
        public function handle(Request $request):void{
            if (!Auth::check()) {
                return;
            }

            $previous = $request->previous();

            if ($previous && !str_contains($previous, '/login')){
                header('Location: ' . $previous);
                exit;
            }

            header('Location: ' . (Auth::role() === 'admin' ? '/admin/dashboard' : '/'));
            exit;
        }
    }