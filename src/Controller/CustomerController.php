<?php


namespace App\Controller;


use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CustomerController
 * @package App\Controller
 * @Route("/customer")
 */
class CustomerController extends AbstractController
{
    private CustomerRepository $customerRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(
        CustomerRepository $customerRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->customerRepository = $customerRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("", name="customer")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response {
        $customers = $this->customerRepository->pagination(
            $request->query->getInt('page', 1)
        );

        return $this->render('customer/index.html.twig', [
            'customers' => $customers
        ]);
    }

    /**
     * @Route("/add", name="customer_add")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request): Response {
        $customer = new Customer();

        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($customer);
            $this->entityManager->flush();

            $this->addFlash('success', "The customer has been created.");
        }

        return $this->render('customer/add.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/edit/{customer}", name="customer_edit")
     * @param Request $request
     * @param Customer $customer
     * @return Response
     */
    public function edit(Request $request, Customer $customer): Response {
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            $this->addFlash('success', "The customer has been updated.");
            return $this->redirectToRoute('customer');
        }

        return $this->render('customer/edit.html.twig', [
            'form' => $form->createView(),
            'customer' => $customer
        ]);
    }

    /**
     * @Route("/delete/{customer}", name="customer_delete")
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function delete(Customer $customer): RedirectResponse {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $this->entityManager->remove($customer);
        $this->entityManager->flush();

        $this->addFlash('success', "The customer has been deleted.");
        return $this->redirectToRoute('customer');
    }
}