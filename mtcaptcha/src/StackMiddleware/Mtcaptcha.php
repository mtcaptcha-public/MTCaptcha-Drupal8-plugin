<?php

namespace Drupal\mtcaptcha\StackMiddleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Drupal\mtcaptcha\Admin\MTCaptchaSettings;

/**
 * Provides a HTTP middleware.
 */
class Mtcaptcha implements HttpKernelInterface {

  /**
   * The wrapped HTTP kernel.
   *
   * @var \Symfony\Component\HttpKernel\HttpKernelInterface
   */
  protected $httpKernel;

  /**
   * Constructs a MyModule object.
   *
   * @param \Symfony\Component\HttpKernel\HttpKernelInterface $kernel
   *   The decorated kernel.
   * @param mixed $optional_argument
   *   (optional) An optional argument.
   */
  public function __construct(HttpKernelInterface $http_kernel) {
    $this->httpKernel = $http_kernel;
  }

  /**
   * {@inheritdoc}
   */
  public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = TRUE) {
    return $this->httpKernel->handle($request, $type, $catch);
  }
}