// PAGINATOR CLASS (independent)
class Paginator {
    constructor({ container, initialData, onPageChange }) {
        this.container = $(container);
        this.onPageChange = onPageChange;
        this.data = {
            total: 0,
            currentPage: 1,
            perPage: 10,
            totalPages: 1
        };
        
        if(initialData) this.updateData(initialData);
        this.render();
        this.setupEvents();
    }

    updateData({ total, currentPage = 1, perPage = 10 }) {
        console.log(perPage)
        this.data = {
            total: Number(total) || 0,
            currentPage: Math.min(
                Math.max(1, Number(currentPage)), 
                Math.ceil(Number(total) / Number(perPage))
            ),
            perPage: Number(perPage) || 10,
            totalPages: Math.ceil(Number(total) / Number(perPage)) || 1
        };
        this.render();
    }

    setupEvents() {
        this.container.off('click', '.page').on('click', '.page', (e) => {
            const $target = $(e.currentTarget);
            const $parentLi = $target.closest('.page-item');
            
            // Bloquear clicks en elementos deshabilitados
            if($parentLi.hasClass('disabled')) {
                e.preventDefault();
                e.stopImmediatePropagation();
                return false;
            }

            e.preventDefault();
            const newPage = parseInt($target.data('page'));
            if(!isNaN(newPage) && newPage !== this.data.currentPage) {
                this.data.currentPage = newPage;
                console.log("-----------",this.data);
                this.onPageChange(this.data);
                this.render();
            }
        });
    }

    render() {
        const { total, currentPage, perPage, totalPages } = this.data;
        const start = (currentPage - 1) * perPage + 1;
        const end = Math.min(start + perPage - 1, total);

       this.container.html(`
          <div class="pagination-wrapper">
            <div class="pagination-info">
              Showing ${start}-${end} of ${total}
            </div>
            <nav>
              <ul class="pagination pagination-sm no-margin">
                ${this.generateButtons()}
              </ul>
            </nav>
          </div>
        `);

    }

    generateButtons() {
        const { currentPage, totalPages } = this.data;
        const buttons = [];
        const maxButtons = 5;
        let start = Math.max(1, currentPage - Math.floor(maxButtons / 2));
        let end = Math.min(totalPages, start + maxButtons - 1);

        if(end - start < maxButtons - 1) {
            start = Math.max(1, end - maxButtons + 1);
        }

        // Previous Button (mejorado)
        buttons.push(`
            <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a href="#" class="page" 
                   data-page="${currentPage - 1}"
                   ${currentPage === 1 ? 'tabindex="-1" aria-disabled="true"' : ''}>
                    &laquo;
                </a>
            </li>
        `);

        // Numbered Buttons
        for(let i = start; i <= end; i++) {
            buttons.push(`
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a href="#" class="page" data-page="${i}">${i}</a>
                </li>
            `);
        }

        // Next Button (mejorado)
        buttons.push(`
            <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                <a href="#" class="page" 
                   data-page="${currentPage + 1}"
                   ${currentPage === totalPages ? 'tabindex="-1" aria-disabled="true"' : ''}>
                    &raquo;
                </a>
            </li>
        `);

        return buttons.join('');
    }
}

