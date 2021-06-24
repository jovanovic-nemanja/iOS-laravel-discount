//
//  FeaturedViewController.swift
//  ThatDubaiGirl
//
//  Created by Bozo Krkeljas on 20.12.20..
//

import UIKit

class FeaturedViewController: UIViewController, UITableViewDelegate, UITableViewDataSource, UISearchResultsUpdating {
//class FeaturedViewController: UIViewController, UITableViewDelegate, UITableViewDataSource {

    var discounts: [Discount] = []
    private var filteredDiscounts: [Discount] = []
    @IBOutlet weak var tableView: UITableView!
    
    var searchController = UISearchController()

    var refreshControl: UIRefreshControl = {
        return UIRefreshControl()
    }()
    
    func updateTableView() {
        discounts.removeAll()
        for discount in DataManager.discounts {
            if (Int(discount.status!) == 2) { // Only featured
                discounts.append(discount)
            }
        }
        
        tableView.reloadData()
    }
    
    @objc func refresh(sender: AnyObject) {
        DataManager.loadDatas(self.view) {
            DispatchQueue.main.async {
                self.updateTableView()
                self.refreshControl.endRefreshing()
                self.view.setNeedsDisplay()
            }
        }
    }

    func setupPullToRefresh() {
        refreshControl.attributedTitle = NSAttributedString(string: "Pull to refresh", attributes: [.foregroundColor: UIColor.white])
        refreshControl.backgroundColor = .black
        refreshControl.tintColor = .white
        refreshControl.addTarget(self, action: #selector(refresh), for: .valueChanged)
        tableView.addSubview(refreshControl)
    }

    override func viewDidLoad() {
        super.viewDidLoad()

        // Do any additional setup after loading the view.
        searchController = ({
            let controller = UISearchController(searchResultsController: nil)
            controller.searchResultsUpdater = self
            controller.searchBar.sizeToFit()
            controller.searchBar.placeholder = "Search Discounts"
            controller.obscuresBackgroundDuringPresentation = false;

            tableView.tableHeaderView = controller.searchBar
            return controller
        })()
        
        self.definesPresentationContext = true
        
        // Setup Pull to Refresh
        setupPullToRefresh()

        tableView.register(UINib(nibName: "SolarisTableViewCell", bundle: nil), forCellReuseIdentifier: "SolarisCell")
        tableView.register(UINib(nibName: "DiscountTableViewCell", bundle: nil), forCellReuseIdentifier: "DiscountCell")
        tableView.tableFooterView = UIView()
        
        tableView.rowHeight = (tableView.frame.size.width / 2) + 138
        tableView.estimatedRowHeight = 130

        DataManager.loadDatas(self.view) {
            self.updateTableView()
        }
    }
    
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        // Get the new view controller using segue.destination.
        // Pass the selected object to the new view controller.
        if (segue.identifier == "detail") {
            let discount = sender as! Discount
            if let vcDetail = segue.destination as? DetailViewController {
                vcDetail.discount = discount
            }
        }
    }
    
    // MARK: - UITableViewDelegate, UITableViewDataSource
    
    func numberOfSections(in tableView: UITableView) -> Int {
        // #warning Incomplete implementation, return the number of sections
        return 1
    }

    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        // #warning Incomplete implementation, return the number of rows
        var count = 0
        if (searchController.isActive) {
            count = filteredDiscounts.count
        } else {
            count = discounts.count
        }
        
        return (count == 0) ? count : count + 1
    }
    
    func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        var count = 0
        if (searchController.isActive) {
            count = filteredDiscounts.count
        } else {
            count = discounts.count
        }

        if indexPath.row < count {
            return tableView.frame.width / 2 + 138
        } else {
            return 64
        }
    }

    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        var count = 0
        if (searchController.isActive) {
            count = filteredDiscounts.count
        } else {
            count = discounts.count
        }
        
        if indexPath.row < count {
            let cell = tableView.dequeueReusableCell(withIdentifier: "DiscountCell", for: indexPath) as! DiscountTableViewCell
            
            cell.viewCard.layer.cornerRadius = 8
            cell.ivVendor.layer.cornerRadius = cell.ivVendor.bounds.width / 2

            var discount: Discount?
            if (searchController.isActive) {
                discount = filteredDiscounts[indexPath.row]
            } else {
                discount = discounts[indexPath.row]
            }

            // Configure the cell...
            cell.configure(discount!)

            return cell
        }
        
        let cell = tableView.dequeueReusableCell(withIdentifier: "SolarisCell", for: indexPath) as! SolarisTableViewCell
        cell.selectionStyle = .none
        return cell
    }

    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        var count = 0
        if (searchController.isActive) {
            count = filteredDiscounts.count
        } else {
            count = discounts.count
        }

        if indexPath.row < count {
            let discount = searchController.isActive ? filteredDiscounts[indexPath.row] : discounts[indexPath.row]
            self.performSegue(withIdentifier: "detail", sender: discount)
        } else {
            if let url = URL(string: "https://www.solarisdubai.com") {
                UIApplication.shared.open(url)
            }
        }
    }
    /*
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        var count = 0
        if (searchController.isActive) {
            count = filteredDiscounts.count
        } else {
            count = discounts.count
        }

        if count == 0 {
            return 0
        }
        
        return 64
    }
    
    func tableView(_ tableView: UITableView, viewForFooterInSection section: Int) -> UIView? {
        let customView = UIView(frame: CGRect(x: 0, y: 0, width: tableView.frame.width, height: 64))
        let button = UIButton(frame: CGRect(x: 0, y: 0, width: tableView.frame.width, height: 48))
//        button.setImage(UIImage(named: "Solaris"), for: .normal)
        button.setTitle("Powered by Solaris Tech", for: .normal)
        button.titleEdgeInsets = UIEdgeInsets.init(top: 0, left: 0, bottom: 0, right: 0)
        button.contentHorizontalAlignment = .center
        button.addTarget(self, action: #selector(buttonAction), for: .touchUpInside)
        customView.addSubview(button)
        
        return customView
    }*/

    // MARK: - UISearchResultsUpdating
    func updateSearchResults(for searchController: UISearchController) {
        filteredDiscounts.removeAll()
        
        let key = searchController.searchBar.text
        if (key?.count == 0) {
            filteredDiscounts = discounts.filter({ (Discount) -> Bool in
                return true
            })
        } else {
            for discount in DataManager.discounts {
                if let _ = discount.title?.range(of: key!, options: .caseInsensitive) {
                    self.filteredDiscounts.append(discount)
                    continue
                }
                
                if let _ = discount.description?.range(of: key!, options: .caseInsensitive) {
                    self.filteredDiscounts.append(discount)
                    continue
                }
                
                if let _ = discount.vendorName?.range(of: key!, options: .caseInsensitive) {
                    self.filteredDiscounts.append(discount)
                    continue
                }
            }
        }
        
        self.tableView.reloadData()
    }
}
