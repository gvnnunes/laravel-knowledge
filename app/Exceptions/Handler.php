<?php

namespace App\Exceptions;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Participant;
use App\Models\Speaker;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            $previous = $e->getPrevious();

            if ($previous instanceof ModelNotFoundException) {
                $model = app()->make($previous->getModel());

                if (
                    $model instanceof Event
                    || $model instanceof Participant
                    || $model instanceof Speaker
                    || $model instanceof EventCategory
                ) {
                    return response()->json([
                        'message' => $model->readableModelName() . ' not found'
                    ], Response::HTTP_NOT_FOUND);
                }
            }

            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Method not allowed'
                ], Response::HTTP_METHOD_NOT_ALLOWED);
            }
        });
    }
}
