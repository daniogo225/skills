<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerCrud extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $name, $email, $phone, $address, $customerId;
    public $updateMode = false;
    public $isModalOpen = false;
    public $showAlertModal = false;
    public $showDeleteConfirmation = false; // Property to control delete confirmation modal visibility
    public $customerToDelete = null; // Property to store the ID of the customer to be deleted

    // Add listeners for the component events
    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        // Check if there's a flash message and show the alert modal
        if (session()->has('message')) {
            $this->showAlertModal = true;
        }
    }

    public function render()
    {
        return view('livewire.customer.customer-crud', [
            'customers' => Customer::paginate(5),
        ]);
    }

    // Reset page when performing a search or filter
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->address = '';
        $this->customerId = null;
        $this->updateMode = false;
    }

    // New method to open the modal for creating a new customer
    public function openModal()
    {
        $this->resetInputFields();
        $this->isModalOpen = true;
        $this->updateMode = false;
    }

    // Updated method to open the modal for editing with proper data loading
    public function openEditModal($id)
    {
        $this->resetValidation(); // Reset any previous validation messages
        $customer = Customer::findOrFail($id);

        if ($customer) {
            $this->customerId = $customer->id;
            $this->name = $customer->name;
            $this->email = $customer->email;
            $this->phone = $customer->phone;
            $this->address = $customer->address;
            $this->updateMode = true;
            $this->isModalOpen = true;

            // Force a re-render to ensure the form shows the loaded data
            $this->dispatch('customer-data-loaded');
        } else {
            session()->flash('type', 'error');
            session()->flash('message', 'Client introuvable.');
            $this->showAlertModal = true;
        }
    }

    // New method to close the modal
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetInputFields();
        $this->resetValidation(); // Reset validation when closing modal
    }

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|min:10',
        'address' => 'required|min:5',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        try {
            $this->validate();

            Customer::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
            ]);

            session()->flash('type', 'success');
            session()->flash('message', 'Client créé avec succès.');
            $this->showAlertModal = true;
            $this->resetInputFields();
            $this->closeModal();
        } catch (\Exception $e) {
            session()->flash('type', 'error');
            session()->flash('message', 'Erreur lors de la création du client: ' . $e->getMessage());
            $this->showAlertModal = true;
        }
    }

    // Original edit method is maintained but we'll primarily use openEditModal now
    public function edit($id)
    {
        $this->openEditModal($id);
    }

    public function update()
    {
        try {
            $this->validate();

            if ($this->customerId) {
                $customer = Customer::find($this->customerId);
                if ($customer) {
                    $customer->update([
                        'name' => $this->name,
                        'email' => $this->email,
                        'phone' => $this->phone,
                        'address' => $this->address,
                    ]);

                    session()->flash('type', 'success');
                    session()->flash('message', 'Client mis à jour avec succès.');
                    $this->showAlertModal = true;
                    $this->resetInputFields();
                    $this->closeModal();
                } else {
                    throw new \Exception('Customer not found');
                }
            }
        } catch (\Exception $e) {
            session()->flash('type', 'error');
            session()->flash('message', 'Erreur lors de la mise à jour du client: ' . $e->getMessage());
            $this->showAlertModal = true;
        }
    }

    // Method to show delete confirmation modal
    public function confirmDelete($id)
    {
        $this->customerToDelete = $id;
        $this->showDeleteConfirmation = true;
    }

    // Method to cancel deletion
    public function cancelDelete()
    {
        $this->customerToDelete = null;
        $this->showDeleteConfirmation = false;
    }

    // Renamed method to perform deletion after confirmation
    public function deleteCustomer()
    {
        try {
            if ($this->customerToDelete) {
                Customer::findOrFail($this->customerToDelete)->delete();
                session()->flash('type', 'success');
                session()->flash('message', 'Client supprimé avec succès.');
                $this->showAlertModal = true;
                $this->customerToDelete = null;
                $this->showDeleteConfirmation = false;
            }
        } catch (\Exception $e) {
            session()->flash('type', 'error');
            session()->flash('message', 'Erreur lors de la suppression du client: ' . $e->getMessage());
            $this->showAlertModal = true;
            $this->customerToDelete = null;
            $this->showDeleteConfirmation = false;
        }
    }

    // Original delete method now redirects to confirmation
    public function delete($id)
    {
        $this->confirmDelete($id);
    }

    // Method to close the alert modal
    public function closeAlertModal()
    {
        $this->showAlertModal = false;
    }
}

