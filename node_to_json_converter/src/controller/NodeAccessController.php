<?php

namespace Drupal\node_to_json_converter\controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class NodeAccessController Controller.
 */
class NodeAccessController extends ControllerBase {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Service enabling use of Drupal config system.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * The serializer which serializes the views result.
   *
   * @var \Symfony\Component\Serializer\SerializerInterface
   */
  protected $serializer;

  /**
   * The logger service.
   *
   * @var \Drupal\Core\Logger\LoggerChannelInterface
   */
  protected $logger;

  /**
   * {@inheritdoc}
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager,
                              ConfigFactoryInterface $config_factory,
                              SerializerInterface $serializer_interface,
                              LoggerChannelFactoryInterface $logger_factory) {
    $this->entityTypeManager = $entity_type_manager;
    $this->configFactory = $config_factory;
    $this->serializer = $serializer_interface;
    $this->logger = $logger_factory->get('node_to_json_converter');
  }

  /**
   * {@inheritdoc}
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The Drupal service container.
   *
   * @return static
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('config.factory'),
      $container->get('serializer'),
      $container->get('logger.factory')
    );
  }

  /**
   * This function converts node data into json format.
   *
   * @param string $api_key
   *   This contains API key needed to access the json data.
   * @param string $node_id
   *   Node ID of a node, to get the data based on id.
   *
   * @return Symfony\Component\HttpFoundation\JsonResponse
   *   Returns correct JSON response.
   */
  public function pageNodeAccess($api_key, $node_id) {
    // Loading the Node using the Node id from the request URL.
    $node_detail = $this->entityTypeManager()->getStorage('node')->load($node_id);

    // Getting "Site API Key" value from site system configuration.
    $system_config = $this->configFactory->get('system.site');
    $siteinfo_apikey = $system_config->get('siteapikey');

    // Getting node type, if node is not empty.
    if (isset($node_detail)) {
      $node_type = $node_detail->getType();
    }

    // Checking key matches the config key and node is not empty & page type.
    if ((isset($node_detail)) && ($siteinfo_apikey == $api_key) && ($node_type == 'page')) {
      // Serializing page node type data in the form of JSON representation.
      $node_json = $this->serializer->serialize($node_detail, 'json', ['plugin_id' => 'entity']);
      // Creating new reponse to load JSON content inside it.
      $resulted_json = new Response();
      $resulted_json->setContent($node_json);
      // Setting header for JSON response.
      $resulted_json->headers->set('Content-Type', 'application/json');

      // Logging Access message for admin reporting purpose.
      $log_message = 'Authorised Activity : Last valid access was done on -- API KEY: ' . $api_key . ' -- Node_ID: ' . $node_id . ' -- submitted on : ' . date("Y-m-d h:i:sa");
      $this->logger->info($log_message);

      // Returns correct JSON response.
      return $resulted_json;
    }
    else {
      // Logging access message for error or unauthorised access to our json.
      $log_message = 'Unauthorised Activity : Someone unauthorise person tried to access json data' . ' -- API KEY: ' . $api_key . ' -- Node_ID: ' . $node_id . ' -- submitted on : ' . date("Y-m-d h:i:sa");
      $this->logger->error($log_message);

      // JSON response for not valid values.
      return new JsonResponse(["error" => "access denied"], 401, ['Content-Type' => 'application/json']);
    }
  }

}
