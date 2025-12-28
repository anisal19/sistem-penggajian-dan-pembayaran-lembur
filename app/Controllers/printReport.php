public function printReport()
{
    $payrollModel = new PayrollModel();
    $payrolls = $payrollModel->findAll();

    return view('payroll/print_report', ['payrolls' => $payrolls]);
}
