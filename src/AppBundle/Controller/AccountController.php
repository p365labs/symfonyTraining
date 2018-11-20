<?php declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Entity\Account;
use AppBundle\Form\AccountType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

class AccountController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/accounts/list", name="account_list", methods={"GET"})
     */
    public function showAction(Request $request)
    {
        $accounts = $this->get('doctrine')->getRepository(Account::class)->findAll();

        return $this->render('@App/Account/list.html.twig', array(
            'accounts' => $accounts,
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/accounts/add", name="account_add", methods={"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $account = new Account();
        $form = $this->createForm(AccountType::class, $account);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->get('doctrine')->getManager();
            $entityManager->persist($account);

            $entityManager->flush();


            return $this->redirectToRoute('account_list');
        }

        return $this->render('@App/Account/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}