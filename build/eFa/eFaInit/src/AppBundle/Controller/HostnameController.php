<?php
// src/AppBundle/Controller/LanguageController.php
namespace AppBundle\Controller;

use AppBundle\Entity\HostnameTask;
use AppBundle\Form\HostnameTaskType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HostnameController extends Controller
{
    /**
     * @Route("/{_locale}/hostname",
     *     name="hostnamepage",
     *     defaults={"_locale": "en"}
     * )
     */
    public function indexAction(Request $request, SessionInterface $session)
    {
        $hostnameTask = new HostnameTask();
    
        $form = $this->createForm(HostnameTaskType::class, $hostnameTask, array('hostname' => $session->get('hostname')));
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $hostnameTask = $form->getData();
            
            // Store hostname in session
            $session->set('hostname', $hostnameTask->getHostname());

            $action = $form->get('Back')->isClicked() ? 'languagepage' : 'domainnamepage';

            return $this->redirectToRoute($action, array('_locale' => $request->getLocale()));
        }
    
        return $this->render('hostname/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
?>
